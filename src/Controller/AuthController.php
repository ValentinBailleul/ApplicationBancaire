<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $civilite = $request->request->get('civilite');
        $prenom = $request->request->get('prenom');
        $nom = $request->request->get('nom');
        $datedenaissance = $request->request->get('datedenaissance');
        $adresse = $request->request->get('adresse');
        //Si vous souhaitez que le virement interne fonctionne, veuillez insérer societegenerale pour la banque (afin d'avoir les 5 premiers chiffres identique)
        $banque = $request->request->get('banque');
        $soldeducompte = $request->request->get('soldeducompte');
        $montant = $request->request->get('montant');
        $operation = $request->request->get('operation');
        //Le code pin doit être composé de 6 chiffres
        $pin = random_int(100000, 999999);

        //Le numéro de compte doit être composé de 12 chiffres
        $username = random_int(100000000000, 1000000000000);

        //La variable username correspond au numéro de compte
        $user = new User($nom, $prenom, $civilite, $datedenaissance, $adresse, $banque, $soldeducompte, $montant, $operation);
        $user->setNumeroCompte($username);
        //Le code pin devient le password et tout comme le numéro de compte, il est généré automatiquement après la création du compte !
        $user->setPassword($encoder->encodePassword($user, $pin));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('Votre compte est creer, votre numero de compte est %s et votre code pin est %s', $user->getUsername(), $pin));
    }

    public function api()
    {
        //Connection qui retourne un token sur postman
        return new Response(sprintf('Vous êtes connecté %s', $this->getUser()->getUsername()));
    }

    public function logout(Request $request) {
        //Je suppose, exceptionnellement ici, qu'il est possible en changeant simplement le contenu du jwt de le rendre invalide (biensur, je sais que c'est impossible)s
        $Jwt = "jechangelejwt";
    }
}