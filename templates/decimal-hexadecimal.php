<?php
    template('header', array(
        'title' => 'Boite à outils • Décimal - Hexadécimal',
    ));
?>

<section id="homepage" class="homepage">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur système décimal positif en binaire </h2>
        </div>

        <div class="row">
            <figure class="bg-light rounded p-3">
                <blockquote cite="https://www.huxley.net/bnw/four.html">
                    <p>
                        Le système binaire (du latin binārĭus, « double ») est le système de numération utilisant la base 2. On nomme couramment bit (de l'anglais binary digit, soit « chiffre binaire ») les chiffres de la numération binaire positionnelle. Un bit peut prendre deux valeurs, notées par convention 0 et 1.
                    </p>   <p>
                        Le système binaire est utile pour représenter le fonctionnement de l'électronique numérique utilisée dans les ordinateurs. Il est donc utilisé par les langages de programmation de bas niveau.
                    </p>
                </blockquote>
                <figcaption><cite><a href="https://fr.wikipedia.org/wiki/Syst%C3%A8me_binaire">Wikipedia</a></cite></figcaption>
            </figure>
        </div>

        <div class="row justify-content-center">
            <fieldset class="col-6 mt-4 pb-4">
                <legend>Convertisseur</legend>
                <form action="" name="decimal-hexadecimal">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="decimal">Décimal</label>
                            <div class="input-group">
                                <input id="decimal" name="decimal" type="number" min="0" class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="hex">Héxadécimal</label>
                            <div class="input-group">
                                <input id="hex" name="hex" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="binary">Binaire</label>
                            <div class="input-group">
                                <input id="binary" name="binary" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
            </div>
        </div>
</section>


    <script type="text/javascript">
        window.addEventListener('load', () => {
            let forms = document.forms;
            let decimal = forms['decimal-hexadecimal'].elements['decimal'];
            let hex = forms['decimal-hexadecimal'].elements['hex'];
            let binary = forms['decimal-hexadecimal'].elements['binary'];
            
            decimal.addEventListener('input', () => {
                let value = parseInt(decimal.value, 10);
                if (isNaN(value))
                    return;
                hex.value = value.toString(16);
                binary.value = value.toString(2);
            });

            hex.addEventListener('input', () => {
                let value = parseInt(hex.value, 16)
                if (isNaN(value))
                    return;
                decimal.value = value.toString(10);
                binary.value = value.toString(2);
            });

            binary.addEventListener('input', () => {
                let value = parseInt(binary.value, 2);
                if (isNaN(value))
                    return;
                decimal.value = value.toString(10);
                hex.value = value.toString(16);
            });

        });
    </script>

<?php template('footer');
