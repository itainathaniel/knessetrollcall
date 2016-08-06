<?php

namespace App\Console\Commands;

use App\EntranceLog;
use App\Events\errorFetchingLogEntries;
use App\Events\newKnessetMember;
use App\KnessetMember;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Event;
use Log;
use Yangqi\Htmldom\Htmldom;

class LogEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logging entries of Knesset members in and out.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            //$html = new Htmldom('http://www.knesset.gov.il/presence/heb/PresentList.aspx');
            $html = new Htmldom('http://krc.tempurl.co.il/krc.php');
        } catch (\Exception $e) {
            $error = 'Error while fetching Knesset site.';
            Log::alert($error);
            $this->error($error);
            Event::fire(new errorFetchingLogEntries($error));
            
            $html = $this->backup();
            
            if (!$html) {
                return false;
            }
        }

        $tds = $html->getElementById('dlMkMembers')->find('td');

        $dlMkMembers = [];
        $membersIn = [];
        $membersOut = [];

        foreach ($tds as $k => $td) {
            $a = $td->find('a', 0);
            $image = $td->find('img', 0);

            $dlMkMembers[$k]['knessetId'] = str_replace('/mk/heb/mk.asp?mk_individual_id_t=', '', $a->href);
            $dlMkMembers[$k]['name'] = iconv('ISO-8859-8', 'UTF-8', $a->plaintext);
            $dlMkMembers[$k]['isInside'] = $image->class == 'PhotoAsist';
            $dlMkMembers[$k]['image'] = $image->src;
        }

        $tds = $html->getElementById('dlMinister')->find('td');

        $dlMinister = [];

        foreach ($tds as $k => $td) {
            $a = $td->find('a', 0);
            if (!is_null($a)) {
                $image = $td->find('img', 0);

                $dlMinister[$k]['knessetId'] = str_replace('/mk/heb/mk.asp?mk_individual_id_t=', '', $a->href);
                $dlMinister[$k]['name'] = iconv('ISO-8859-8', 'UTF-8', $a->plaintext);
                $dlMinister[$k]['isInside'] = $image->class == 'PhotoAsist';
                $dlMinister[$k]['image'] = $image->src;
            }
        }

        $members = array_merge($dlMkMembers, $dlMinister);

        foreach ($members as $member) {
            // check if member current state is different from logged
            try {
                $knessetMember = KnessetMember::whereKnessetId($member['knessetId'])->firstOrFail();

                if ($knessetMember->isInside != $member['isInside']) {
                    $knessetMember->updatePresence($member['isInside']);

                    $EntranceLog = new EntranceLog();
                    $EntranceLog['knessetmembers_id'] = $knessetMember->id;
                    $EntranceLog['isInside'] = $member['isInside'];
                    $EntranceLog->save();

                    if ($knessetMember->isInside) {
                        $membersIn[] = $knessetMember;
                    } else {
                        $membersOut[] = $knessetMember;
                    }
                }
            } catch (ModelNotFoundException $e) {
                try {
                    $KnessetMember = new KnessetMember();

                    $KnessetMember['knesset_id'] = $member['knessetId'];
                    $KnessetMember['party_id'] = 0;
                    $KnessetMember['name'] = $member['name'];
                    $KnessetMember['isInside'] = $member['isInside'];
                    $KnessetMember['image'] = $member['image'];

                    $KnessetMember->save();

                    Event::fire(new newKnessetMember($KnessetMember));
                } catch (QueryException $e) {
                    // echo $e->getMessage();
                }
            }
        }

        if (!empty($membersIn)) {
            $members2tweet = [];
            $membersIds2tweet = [];
            foreach ($membersIn as $member) {
                $members2tweet[] = $member->name;
                $membersIds2tweet[] = $member->id;
            }
        }

        if (!empty($membersOut)) {
            $members2tweet = [];
            $membersIds2tweet = [];
            foreach ($membersOut as $member) {
                $members2tweet[] = $member->name;
                $membersIds2tweet[] = $member->id;
            }
        }

        $this->info(count($membersIn).' נכנסו');
        $this->info(count($membersOut).' יצאו');
        Log::notice(count($membersIn).' in, '.count($membersOut).' out');
    }
}
