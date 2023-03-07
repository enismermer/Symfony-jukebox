//////////////////////////LANCEMENT DU PROJET/////////////////////////////


mise en place projet : install composer (si tu fait un git clone d'un projet)

ligne de commande pour l'installation : symfony new my_project_directory --version=5.4 --webapp
crée un nouveau projet :  symfony new projet1 --version=lts
crée un nouveau projet avec webpack :  symfony new article_symfony5 --full  
pour installer twing : composer require twig

stoper un serveur sans fermer vscode : symfony server:stop
lance le serveur : symfony server:start    
help: symfony console

////////////////////////////Cree des nouvelle pages//////////////////////

crée un controler (new page) : symfony console make:controller
                                2 : on met la route dans le fichier sécurity.
                                3 : on définie les roles dans la même page.
                                4 : dans le controleur on rajoute: #[IsGranted('ROLE_aveclenomdurole')]

////////////////////////////Cree les tables//////////////////////////////
                                
LA BDD On modifie: dans .env le nom de la BDD
commande pour crée une BDD: symfony console doctrine:database:create
    1 : crée une table : symfony console make:entity
    2 : migration de bdd: symfony console make:migration
    3 : migration avec doctrine: symfony console dⓂ️m

///////////////////////////////New formulaire//////////////////////////

Crée un formulaire : composer require symfony/form => tu lui donne un nom
on crée un user : symfony console make:user
Les inputes d'un formulaire : on rajoute les types des inpute formulaire
    1 : On ajoute notre balise form a notre vue: {{ form(form) }}

    2 : On ajoute les types de nos inputes exemple: ->add('email',EmailType::class)
                                                    ->add('password',PasswordType::class)
    
    3 : On importe les routes dans nos pages d'inpute exemple: 
                    -> use Symfony\Component\Form\Extension\Core\Type\EmailType;
                    -> use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/////////////////////////////////hasher le password///////////////////////////////////

installer composer: composer require symfony/password-hasher

a rajouter dans config sécurity: 
                        password_hashers:
                        App\Entity\User: 'auto'
                        modifier :   cost:      15 (ligne 44).

A rajouter dans le controller: 
                    use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
                    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

On rajoute les paramettres a la fonction: UserPasswordHasherInterface $passwordHasher


/////////////////////////////////Test////////////////////////////////////////

test: composer require --dev symfony/test-pack

/////////////////////////////////Login///////////////////////////////

crée un login : symfony console make:auth

//////////////////////////////CRUD ADMIN//////////////////////////////////

on fait la commande : php bin/console make:admin:crud

//////////////////////////////////POUR LES API////////////////////////////

on fait la commande : composer require symfony/http-client//////////////////////////LANCEMENT DU PROJET/////////////////////////////


mise en place projet : install composer (si tu fait un git clone d'un projet)

ligne de commande pour l'installation : symfony new my_project_directory --version=5.4 --webapp
crée un nouveau projet :  symfony new projet1 --version=lts
crée un nouveau projet avec webpack :  symfony new article_symfony5 --full  
pour installer twing : composer require twig

stoper un serveur sans fermer vscode : symfony server:stop
lance le serveur : symfony server:start    
help: symfony console

////////////////////////////Cree des nouvelle pages//////////////////////

crée un controler (new page) : symfony console make:controller
                                2 : on met la route dans le fichier sécurity.
                                3 : on définie les roles dans la même page.
                                4 : dans le controleur on rajoute: #[IsGranted('ROLE_aveclenomdurole')]

////////////////////////////Cree les tables//////////////////////////////
                                
LA BDD On modifie: dans .env le nom de la BDD
commande pour crée une BDD: symfony console doctrine:database:create
    1 : crée une table : symfony console make:entity
    2 : migration de bdd: symfony console make:migration
    3 : migration avec doctrine: symfony console dⓂ️m

///////////////////////////////New formulaire//////////////////////////

Crée un formulaire : composer require symfony/form => tu lui donne un nom
on crée un user : symfony console make:user
Les inputes d'un formulaire : on rajoute les types des inpute formulaire
    1 : On ajoute notre balise form a notre vue: {{ form(form) }}

    2 : On ajoute les types de nos inputes exemple: ->add('email',EmailType::class)
                                                    ->add('password',PasswordType::class)
    
    3 : On importe les routes dans nos pages d'inpute exemple: 
                    -> use Symfony\Component\Form\Extension\Core\Type\EmailType;
                    -> use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/////////////////////////////////hasher le password///////////////////////////////////

installer composer: composer require symfony/password-hasher

a rajouter dans config sécurity: 
                        password_hashers:
                        App\Entity\User: 'auto'
                        modifier :   cost:      15 (ligne 44).

A rajouter dans le controller: 
                    use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
                    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

On rajoute les paramettres a la fonction: UserPasswordHasherInterface $passwordHasher


/////////////////////////////////Test////////////////////////////////////////

test: composer require --dev symfony/test-pack

/////////////////////////////////Login///////////////////////////////

crée un login : symfony console make:auth

//////////////////////////////CRUD ADMIN//////////////////////////////////

on fait la commande : php bin/console make:admin:crud

//////////////////////////////////POUR LES API////////////////////////////

on fait la commande : composer require symfony/http-client