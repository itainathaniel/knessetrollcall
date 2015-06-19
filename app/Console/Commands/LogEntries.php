<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use KnessetRollCall\EntranceLog;
use KnessetRollCall\KnessetMember;
use KnessetRollCall\Tweet;
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
            $html = new Htmldom('http://www.knesset.gov.il/presence/heb/PresentList.aspx');
        } catch (ErrorException $e) {
            $this->error('Error while fetching Knesset site.');
            return;
        }

        $tds = $html->getElementById('dlMkMembers')->find('td');

        $members = array();
        $membersIn = array();
        $membersOut = array();

        foreach ($tds as $k => $td) {
            $a = $td->find('a', 0);
            $image = $td->find('img', 0);

            $members[$k]['knessetId'] = str_replace('/mk/heb/mk.asp?mk_individual_id_t=', '', $a->href);
            $members[$k]['name'] = iconv('ISO-8859-8', 'UTF-8', $a->plaintext);
            $members[$k]['isInside'] = $image->class == 'PhotoAsist';
            $members[$k]['image'] = $image->src;
        }

        foreach ($members as $member) {
            // check if member current state is different from logged
            try {
                $knessetMember = KnessetMember::whereKnessetId($member['knessetId'])->firstOrFail();

                if ($knessetMember->isInside == $member['isInside']) {
//                echo $knessetMember->name . ' is still ' . ($knessetMember->isInside ? 'inside' : 'outside') . ' the Knesset building<br>';
                } else {
                    $knessetMember->updatePresence($member['isInside']);

                    $EntranceLog = new EntranceLog();
                    $EntranceLog['knessetmembers_id'] = $knessetMember->id;
                    $EntranceLog['isInside'] = $member['isInside'];
                    $EntranceLog->save();

                    if ($knessetMember->isInside) {
                        $membersIn[] = $knessetMember;
                        $event = 'LogEntries.knessetMemberIn';
                    } else {
                        $membersOut[] = $knessetMember;
                        $event = 'LogEntries.knessetMemberOut';
                    }
                    Event::fire($event, array($knessetMember));

                    $Tweet = new Tweet();
                    $Tweet['tweet'] = $knessetMember->name . ' is now ' . ($knessetMember->isInside ? 'inside' : 'outside') . ' the Knesset building';
                    $Tweet->save();
                }
            } catch (ModelNotFoundException $e) {
                // echo $e->getMessage();
                try {
                    $KnessetMember = new KnessetMember();

                    $KnessetMember['knesset_id'] = $member['knessetId'];
                    $KnessetMember['party_id'] = 0;
                    $KnessetMember['name'] = $member['name'];
                    $KnessetMember['isInside'] = $member['isInside'];
                    $KnessetMember['image'] = $member['image'];

                    $KnessetMember->save();

                    Event::fire('LogEntries.newKnessetMember', array($KnessetMember));
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

            $Tweet = new Tweet();
            $Tweet['tweet'] = Lang::choice('tweets.enter', count($members2tweet), array('members' => implode(', ', $members2tweet)));
            $Tweet['metadata'] = json_encode(['ids' => $membersIds2tweet, 'action' => 1]);
            $Tweet->save();
        }

        if (!empty($membersOut)) {
            $members2tweet = [];
            $membersIds2tweet = [];
            foreach ($membersOut as $member) {
                $members2tweet[] = $member->name;
                $membersIds2tweet[] = $member->id;
            }

            $Tweet = new Tweet();
            $Tweet['tweet'] = Lang::choice('tweets.exit', count($members2tweet), array('members' => implode(', ', $members2tweet)));
            $Tweet['metadata'] = json_encode(['ids' => $membersIds2tweet, 'action' => 0]);
            $Tweet->save();
        }

        $this->info(count($membersIn).' נכנסו');
        $this->info(count($membersOut).' יצאו');
    }
}
