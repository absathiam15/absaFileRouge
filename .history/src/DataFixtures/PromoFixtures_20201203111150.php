    <?php

    namespace App\DataFixtures

    use Faker\Factory;
    use App\Entity\Promo;
    use App\DataFixtures\GroupeFixtures;
    use Doctrine\Persistence\ObjectManager;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;

    class PromoFixtures extends Fixture implements DependentFixtureInterface
    {

        public function load(ObjectManager $manager)
        {
        $faker= Factory::create('fr_FR');

        $promo = new Promo();
        $promo->setAnnee($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setDebut($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setFin($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setLieuPromo($faker->lieuPromo)
        ->setChoixFabrique($faker->choixFabrique)
        ->setReference($this->reference)
        ->setTitre($faker->titre)
        ->setDescription($faker->description)
        ->setEffectifEntrant($faker->effectifEntrant)
        ->setEffectifSortant($faker->effectifSortant);

        $promo->addGroupe($this->getReference(GroupeFixtures::GROUPE_REFERENCE));

        $manager->persist($promo);
        $manager->flush();

        }

        public function getDependencies()
        {
        return array(
        GroupeFixtures::class,
        );
    }
}

