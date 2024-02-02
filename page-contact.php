
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/voitures/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Une Question ? <em>Contactez-nous</em></h2>
                        <p>Remplissez le formulaire pour tout type de question, nous vous répondrons dans un délais de 24h</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Features Item Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>info <em> contact</em></h2>
                        <img src="assets/images/line-dec.png" alt="waves">
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>

                    <h5><a class="text-dark" href="#">06 68 61 58 21</a></h5>

                    <br>
                </div>

                <div class="col-md-4">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <h5><a class="text-dark" href="#">so.location@gmail.com</a></h5>

                    <br>
                </div>

                <div class="col-md-4">
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>

                    <h5>27 Rue du Onze Novembre, <br> 42450, Sury-le-comtal</h5>
                    
                    <br>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Item End ***** -->
   
    <!-- ***** Contact Us Area Starts ***** -->
    <section class="section" id="contact-us" style="margin-top: 0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2033.927659190705!2d4.185966386333934!3d45.53981914778902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f44ac3e8528d85%3A0xb184f993a5578599!2s27%20Rue%20du%20Onze%20Novembre%2C%2042450%20Sury-le-Comtal!5e0!3m2!1sfr!2sfr!4v1671189485747!5m2!1sfr!2sfr"  width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="contact-form section-bg" style="background-image: url(assets/images/voitures/contact-1-720x480.jpg)">
                        <form id="contact" action="" method="post">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" id="name" placeholder="Votre Nom*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="mail" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Votre E-mail*" required="">
                              </fieldset>
                            </div>
                            <div class="col-12  mx-auto">
                                <select name="voiture_choisi" id="voiture_choisi">
                                    <option selected value="" disabled>--choissisez une voiture--</option>
                                          <option name="voiture_choisi"></option>
                                </select>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                              <label for="date_start">Date début</label>
                                <input name="date_start" id="date_start" type="date">
                            </div>
                            <div class="col-md-6 col-sm-12"> 
                              <label for="">Date de fin</label>
                                <input id="date_end"  name="date_end" type="date">
                            </div>    
                              
                            <div class="col-md-12 col-sm-12">
                              <fieldset>
                                <input name="subject" type="text" id="subject" placeholder="Sujet">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Message"></textarea>
                              </fieldset>
                            </div>
                            <div class="col-6">
                              <fieldset>
                                <button name="envoyer" type="submit" id="form-submit"  class="main-button">Envoyer</button>                                
                              </fieldset> 
                            </div>
                            <div class="col-6">                   
                            </div> 
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area Ends ***** -->
  