<?php

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonial = new Testimonial();
        $testimonial->depoiment = 'A Universidade do Autómovel salvou minha vida. Não tenho tempo nem dinheiro para fazer faculdade. Minha meta é tornar-me especialista na minha área e, graças à Universidade do Automóvel, estou a um passo disso.';
        $testimonial->user_name = 'Edmilson Santana';
        $testimonial->user_image = 'testimonial/1/testimonial.jpeg';

        $testimonial->save();
    }
}
