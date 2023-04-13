<?php
template('header', array(
    'title' => 'Boite à outils • Devise',
));
?>

    <!-- ======= About Section ======= -->
    <section id="homepage" class="homepage">
        <div class="container">
            <div class="section-title">
                <h2>Convertisseurs</h2>
            </div>

            <div class="row">
            <fieldset class="col-md-10 offset-md-1 mt-4 pb-4 d-flex justify-content-center">
                <legend>Convertisseur de devises</legend>
                <form action="" method="post" name="convert">
                    <input type="hidden" name="DEVISE"/>
                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            <div class="input-group">
                                <input id="AMOUNT" name="AMOUNT" type="text" class="form-control text-end" required>
                                <select name="FROM" class="form-select pl-1">
                                    <option value="EUR" selected>Euros</option>
                                    <option value="CHF">Franc Suisse</option>
                                    <option value="USD">Dollars</option>
                                    <option value="GBP">Livres Sterling</option>
                                    <option value="RUB">Roubles Russe</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-auto d-inline-flex align-items-center">
                            <span class="ver">vaut actuellement</span>
                        </div>

                        <div class="col-4">
                            <label for="RESULT" aria-hidden="true" hidden>Resultat</label>
                            <div class="input-group">
                                <input id="RESULT" name="RESULT" type="text" class="form-control text-end" disabled>
                                <select name="TO" class="form-select pl-1">
                                    <option value="EUR">Euros</option>
                                    <option value="CHF">Franc Suisse</option>
                                    <option value="USD" selected>Dollars</option>
                                    <option value="GBP">Livres Sterling</option>
                                    <option value="RUB">Roubles Russe</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Calculer</button>
                        </div>
                    </div>
                </form>
            </fieldset>
            </div>

            <div class="row">
            <fieldset class="col-md-10 offset-md-1 mt-4 pb-4 d-flex justify-content-center">
                <legend>Convertisseur de volumes</legend>
                <form action="" method="post" name="convert">
                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            <input type="hidden" name="VOLUME"/>
                            <div class="input-group">
                                <input id="AMOUNT" name="AMOUNT" type="text" class="form-control text-end" required>
                                <select name="FROM" class="form-select pl-1">
                                    <option value="1" selected>Litre</option>
                                    <option value="0.1">Décilitre</option>
                                    <option value="0.01">Centilitre</option>
                                    <option value="0.001">Millilitre</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto d-inline-flex align-items-center">
                            <span class="ver">vaut actuellement</span>
                        </div>

                        <div class="col-4">
                            <label for="RESULT" aria-hidden="true" hidden>Resultat</label>
                            <div class="input-group">
                                <input id="RESULT" name="RESULT" type="text" class="form-control text-end" disabled>
                                <select name="TO" class="form-select pl-1">
                                    <option value="1">Litre</option>
                                    <option value="0.1" selected>Décilitre</option>
                                    <option value="0.01">Centilitre</option>
                                    <option value="0.001">Millilitre</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Calculer</button>
                        </div>
                    </div>
                </form>
            </fieldset>
            </div>
            
        </div>
    </section><!-- End Home Section -->


    <script type="text/javascript">
        window.addEventListener('load', () => {
            let forms = document.forms;

            for(form of forms){
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const formData = new FormData(event.target).entries()

                    const response = await fetch('/api/post', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(
                            Object.assign(Object.fromEntries(formData), {form: event.target.name})
                        )
                    });

                    const result = await response.json();

                    let inputName = Object.keys(result.data)[0];

                    event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
                })
            }
        });
    </script>

<?php template('footer');
