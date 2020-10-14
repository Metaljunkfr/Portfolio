# Portfolio

## Introduction

> Own website to give some informations about me and my work.
<br>You can know me better, get my Resume as img file, see all my projects, how and why I did as I did. 
<br>Also this is possible to write a reference about me (this functionnality requires to be registered and connected) and to contact me within the contact form (no need to register).

## Code Samples

UserController :


        //Création nouvelle instance utilisateur
        $utilisateur = new Utilisateur();

        //Ajout d'une date de création et d'un rôle à l'inscription
        $utilisateur -> setDateCreation(new \DateTime());
        $utilisateur -> setRoles("ROLE_USER");

        //Création de l'instance de la classe formulaire d'inscription
        $inscriptionForm = $this->createForm(InscriptionType::class, $utilisateur);

        //Récupération des données rentrées dans le formulaire
        $inscriptionForm->handleRequest($request);

        //Si inscription ne retourne pas d'erreur
        if ($inscriptionForm->isSubmitted() && $inscriptionForm->isValid())
        {
            //hasher le mot de passe
            $hasher = $encoder->encodePassword($utilisateur, $utilisateur->getMotdepasse());
            $utilisateur->setMotdepasse($hasher);

            //Valider et rentrer les données en base
            $em->persist($utilisateur);
            $em->flush();
			$email= $utilisateur->getEmail();
			
			//Création nouvel objet Email
            $message = (new TemplatedEmail())

                //Contenu du mail
                ->from('contact@guillaumegeorges.fr')
				->to($email)
            	->bcc('contact@guillaumegeorges.fr')
                ->subject('Objet : votre inscription a bien été prise en compte!!')
                ->htmlTemplate('emails/inscription.html.twig')
                ->context([
                    'utilisateur' =>$utilisateur
                ]);
            $mailer->send($message);

            //Message de confirmation d'inscription puis redirection automatique vers la page d'authentification
            $this->addFlash('success', 'L\'inscription a bien été effectuée!');
            return $this->redirectToRoute("connexion");
        }

## Installation

Full code is private because of sensitive informations. If you want to test or to see how it works, you can visit : 
https://www.guillaumegeorges.fr .
Thank you
