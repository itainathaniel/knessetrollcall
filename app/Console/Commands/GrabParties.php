<?php

namespace App\Console\Commands;

use App\KnessetMember;
use App\Party;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psy\Exception\ErrorException;
use Yangqi\Htmldom\Htmldom;

class GrabParties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:parties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs and updates Knesset Members\' party.';

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
        $members = KnessetMember::wherePartyId(0)->take(10)->get();

        if (count($members) == 0) {
            $this->comment('No members to update.');

            return;
        }

        foreach ($members as $member) {
            try {
                $html = new Htmldom('http://www.knesset.gov.il/mk/heb/mk.asp?mk_individual_id_t='.$member->knesset_id);
            } catch (ErrorException $e) {
                $this->error('Error while fetching Knesset site.');

                return;
            }

            $partyDom = $html->find('td.Name .DataText');

            // $party2 = iconv('ISO-8859-8', 'UTF-8', $party[0]->plaintext);
            $partyName = trim($partyDom[0]->plaintext);

            try {
                $Party = Party::whereName($partyName)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $Party = new Party();
                $Party->name = $partyName;
                $Party->save();

                $this->comment('Inserted {'.$partyName.'} as {'.$Party->id.'}');
            }

            $member->party_id = $Party->id;
            $member->save();

            $this->info('Updated {'.$member->name.'} to PartyName {'.$Party->name.'} / PartyId {'.$Party->id.'}');
        }
    }
}
