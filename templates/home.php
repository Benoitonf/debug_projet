<?php
template('header', array(
    'title' => 'Boite à outils • Accueil',
));

$messages = [];
// Send contact form to database
if (!empty($_POST)) {
    $submited_items = array(
        'name' => htmlspecialchars($_POST['name'], ENT_QUOTES),
        'email' => $_POST['email'],
        'subject' => htmlspecialchars($_POST['subject'], ENT_QUOTES),
        'message' => htmlspecialchars($_POST['message'], ENT_QUOTES),
        'checkbox' => isset($_POST['checkbox']) ? $_POST['checkbox'] : null
    );
    
    $validated_items = validate($submited_items, array(
        'name' => array(
            'label' => 'Name',
            'required' => true,
            'sanitize' => 'string',
            'min' => 2,
            'regexp' => '/^[a-zA-Z\' ]+$/'
        ),
        'email' => array(
            'label' => 'Email',
            'required' => true,
            'sanitize' => 'email',
            'regexp' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i'
        ),
        'subject' => array(
            'label' => 'Subject',
            'required' => true,
            'sanitize' => 'string',
        ),
        'message' => array(
            'label' => 'Message',
            'required' => true,
            'sanitize' => 'string',
        ),
        'checkbox' => array(
            'label' => 'Données personnelles',
            'required' => true
        )
    ));

    $result = check_validation($validated_items, array('remove' => 'checkbox'));

    if (!is_passed($result)) {
        $messages = $result;
    } else {
        if (mail($_POST['email'], "MyToolBox - Formulaire de contact", "Bonjour ".$_POST['name'].",\n\nNous avons bien reçu votre demande.\nMytoolbox.")) {
            if(insert('admin_messages', $result)) {
                $messages['success'][] = 'Message envoyé !';
            }
        }
    }
}
?>

<!-- ======= About Section ======= -->
<section id="homepage" class="homepage">
    <div class="container">
        <div class="section-title">
            <h2>La boite à outils</h2>
            <p>La boite à outils est un site accessible 24h/24 et 7j/7 qui vous permet de réaliser un bon nombre de calculs ou transformations nécessaires au quotidien</p>
            <p>Transformer 1/4 de litres en millilitres ou encore convertir des euros en dollars n'a jamais été aussi simple !</p>
        </div>
        <div class="row justify-content-center">
            
            <div class="col-lg-6 border p-4 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <h3>Il vous manque une fonctionnalité ?</h3>
                <p class="fst-italic">
                    Écrivez-nous grâce au formulaire de contact et nous vous répondrons dans les plus brefs délais.
                </p>
                <?php getAlert($messages); ?>
                <form id="contact-form" name="contact-form" method="POST">
                    <!--Grid row-->
                    <div class="row">
                            <label for="name" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom">
                            </div>
                    </div>
                    <div class="row mt-4">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Votre email pour vous répondre">
                        </div>
                    </div>
                    <div class="row mt-4">
                            <label for="subject" class="col-sm-2 col-form-label">Objet</label>
                            <div class="col-sm-10">
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Objet de votre demande">
                        </div>
                    </div>
                    <div class="row mt-4">
                            <label for="message" class="col-sm-2 col-form-label">Demande</label>
                            <div class="col-sm-10">
                                <textarea id="message" name="message" rows="5" class="form-control md-textarea" placeholder="Écrivez votre demande"></textarea>
                            </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="checkbox">
                                <label class="form-check-label" for="flexCheckDefault">
                                    J'accepte que mes données soient utilisées dans le cadre de demande de fonctionnalité
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary w-50">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section><!-- End Home Section -->


<?php template('footer');
