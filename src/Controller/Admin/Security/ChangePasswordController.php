<?php

namespace App\Controller\Admin\Security;

use App\Form\ChangePasswordType;
use App\Entity\Admin\ChangePassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangePasswordController extends AbstractController
{
    /**
     * @Route("/admin/change-password", name="app_change_password")
     */
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, TokenStorageInterface $token)
    {
        $changePassword = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePassword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getUser()->setPassword($encoder->encodePassword($this->getUser(), $form['newPassword']->getData()));

            $manager->persist($this->getUser());
            $manager->flush();

            $token->setToken(null);

            $this->addFlash('success', 'Votre mot de passe a bien été changé, veuillez vous reconnecter');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('admin/change_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
