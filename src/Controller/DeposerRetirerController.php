<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DeposerRetirerController extends AbstractController
{
    //Comme demander ,on seul service sera exposé pour ces deux opérations
    public function deposer_retirer_argent(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        //Insérer ici le montant que vous souhaitez retirer (donc un nombre négatif) ou déposer (un chiffre positif)
        $montant = -110;
        $username = $json["username"];
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('App\Entity\User')->findOneBy(array('username' => $username));
        if($montant < 0)
        {
            $nouveauMontant = $product->getSoldeducompte() + $montant;
            if($nouveauMontant < 0)
            {
                //Le seuil minimum a été atteint, plus d'argent disponible !
                return new Response(sprintf('Impossible de retirer autant'));
            }
            else
            {
                $product->setSoldeducompte($nouveauMontant);
                $em->flush();
                return new Response(sprintf('Votre nouveau solde est de  %s', $nouveauMontant));
            }
        }
        else{
            $nouveauMontant = $product->getSoldeducompte() + $montant;
            $product->setSoldeducompte($nouveauMontant);
            $em->flush();
            return new Response(sprintf('Votre nouveau solde est de  %s', $nouveauMontant));

        }

    }
}