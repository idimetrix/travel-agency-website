<section class="contacts-page-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 second-mob-block">
                <div class="sub-title-wrap">
                    <h1>Контакты</h1>
                    <div class="for-line"></div>
                </div>

                <div class="contact-info-block">
                    <div class="sub-contact-info-block-wrap">
                        <div class="img-wrap">
                            <img alt="image" src="{{asset('/images/phone-icon.png')}}"/>
                        </div>
                        <a href="tel:+79536222257">+7 (953) 622 22 57</a>
                    </div>
                    <div class="sub-contact-info-block-wrap">
                        <div class="img-wrap">
                            <img alt="image" src="{{asset('/images/mailicon.svg')}}"/>
                        </div>
                        <a href="mailto:tour@cronix.ms">tour@cronix.ms</a>
                    </div>

                    <div class="line-mob"></div>

                    <div class="sub-contact-info-block-wrap address-block">
                        <div class="img-wrap">
                            <img alt="image" src="{{asset('/images/address.png')}}"/>
                        </div>
                        <span>Орел, ул.Ленина, 17 <br> ТЦ "Малиновая вода" 1 этаж</span>
                    </div>

                    <div class="sub-contact-info-block-wrap">
                        <div class="img-wrap">
                            <img alt="image" src="{{asset('/images/clock.png')}}"/>
                        </div>
                        <span>График работы:<br>10:00-20:00</span>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 first-mob-block">
                <form id="contact-form">
                    <div class="title-form-wrap">
                        <h3>
                            Оставьте заявку, <br>
                            и мы свяжемся с Вами
                        </h3>
                        <div class="line"></div>
                    </div>
                    <div class="fields-block">
                        <input class="name-input-field" type="text" name="name" placeholder="Имя"/>
                        <input class="number-input-field" type="text" name="phone" placeholder="Телефон"/>
                        <textarea placeholder="Вопрос" name="message"></textarea>
                        <div class="check-box-wrap">
                            <input type="checkbox" checked="" id="access" class="custom-check">
                            <label class="check-label" for="access"> Я принимаю Правила передачи <br> и обработки
                                персональных данных</label>
                        </div>
                        <button type="submit" class="btn-blue submit-button">
                            ОТПРАВИТЬ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
