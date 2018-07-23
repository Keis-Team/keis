<div class="col-12 col-md-8">
    <div class="contact-form-area">
        <h2>Get in touch</h2>
        {{ form('class': 'form-search') }}
        <div class="row">
            {{ form.render('csrf', ['value': security.getToken()]) }}
            <div class="col-12 col-md-6">
                {{ form.render('email',["class": "form-control"]) }}
            </div>
            <div class="col-12 col-md-6">
                {{ form.render('password',["class": "form-control",'autocomplete':"off"]) }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                {{ form.render('login') }}
            </div>
            <div class="col-12 col-md-6">
                {{ form.render('remember') }}
                {{ form.label('remember') }}
                {{ link_to("session/forgotPassword", "Forgot my password") }}
            </div>
        </div>
    </div>
    </form>
</div>
