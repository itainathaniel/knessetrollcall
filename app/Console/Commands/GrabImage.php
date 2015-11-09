<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use KnessetRollCall\KnessetMember;
use Yangqi\Htmldom\Htmldom;

class GrabImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs Knesset Members\' image.';

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
        $html = new Htmldom('http://www.knesset.gov.il/presence/heb/PresentList.aspx');

        $tds = $html->getElementById('dlMkMembers')->find('td');

        $members = [];

        foreach ($tds as $k => $td) {
            $a = $td->find('a', 0);
            $image = $td->find('img', 0);

            $members[$k]['knessetId'] = str_replace('/mk/heb/mk.asp?mk_individual_id_t=', '', $a->href);
            $members[$k]['src'] = $image->src;
        }

        foreach ($members as $member) {
            // check if member current state is different from logged
            try {
                $knessetMember = KnessetMember::whereKnessetId($member['knessetId'])->firstOrFail();

                $knessetMember->updateImage($member['src']);

                echo $member['knessetId'].' has an image: '.$member['src']." <br>\n";
            } catch (ModelNotFoundException $e) {
                // echo $e->getMessage();
            }
        }
    }
}
