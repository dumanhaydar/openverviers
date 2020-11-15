<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;

class ParseVerviersBe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:verviers-be';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Verviers.be';

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
     * @return int
     */
    public function handle()
    {
        return $this->parseEducation();
    }

    private function parseEducation() {
        $urls = [
            'enseignement_fondamental'  =>  'https://www.verviers.be/ma-ville/education/enseignement-fondamental',
            'enseignement_secondaire'   =>  'https://www.verviers.be/ma-ville/education/enseignement-secondaire',
            'enseignement_specialise'   =>  'https://www.verviers.be/ma-ville/education/enseignement-specialise',
            'enseignement_superieur'    =>  'https://www.verviers.be/ma-ville/education/enseignement-superieur',
            'enseignement_artistique'   =>  'https://www.verviers.be/ma-ville/education/enseignement-artistique',
            'service_de_linstruction'   =>  'https://www.verviers.be/ma-ville/education/service-de-linstruction',
            'accueil_temps_libre'       =>  'https://www.verviers.be/ma-ville/education/accueil-temps-libre',
            'autres_ecoles'             =>  'https://www.verviers.be/ma-ville/education/autres-ecoles',
            'ecoles_communales'       =>  'https://www.verviers.be/ma-ville/education/ecoles-communales',
        ];


        $client = new Client();
        $crawler = $client->request('GET', $urls['enseignement_fondamental']);

        $crawler->filter('.related-contact .coordinates .wrapped-coord')->each(function ($node) {
           $this->parseAddress($node);
        });

    }

    private function parseAddress($node) {
        global $address;
        $address = [];
        $node->filter('.related-contact-title')->each(function ($n) {
            global $address;
            $address['title'] = $n->text();
        });
        $node->filter('.address .street')->each(function ($n) {
            global $address;
            $address['street'] = $n->text();
        });
        $node->filter('.address .city .zipcode')->each(function ($n) {
            global $address;
            $address['zipcode'] = $n->text();
        });
        $node->filter('.address .city .cityname')->each(function ($n) {
            global $address;
            $address['city'] = $n->text();
        });
        $node->filter('.coordinates-tab .phone')->each(function ($n) {
            global $address;
            $address['phone'] = $n->text();
        });
        $node->filter('.coordinates-tab .email')->each(function ($n) {
            global $address;
            $address['email'] = $n->text();
        });
        $node->filter('.coordinates-tab .website .website')->each(function ($n) {
            global $address;
            $address['website'] = $n->link()->getUri();
        });
        var_dump($address); die;
    }
}
