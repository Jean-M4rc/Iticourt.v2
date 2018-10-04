<div class="form-group"><!-- mail -->

    <label>Adresse mail <span style="color:red">*</span></label>
    <input class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" type="email" required>
    <small id="emailHelp" class="form-text text-muted">Nous ne transmettrons jamais votre email à un tiers.</small>

    @if ($errors->has('email'))
        <p class="form-text text-danger"> {{ $errors->first('email') }}</p>
    @endif

</div>

<div class="form-group"><!-- prénom -->

    <label>Prénom / Pseudo <span style="color:red">*</span></label>
    <input class="form-control" name="nickname" placeholder="Prénom" type="text" required>
    <small id="nicknameHelp" class="form-text text-muted">Minimum 4 caractères.</small>

    @if ($errors->has('nickname'))
        <p class="form-text text-danger"> {{ $errors->first('nickname') }}</p>
    @endif

</div>

<div class="form-group"><!-- nom -->

    <label>Nom (facultatif)</label>
    <input class="form-control" name="firstname" placeholder="Nom" type="text">

    @if ($errors->has('firstname'))
        <p class="form-text text-danger"> {{ $errors->first('firstname') }}</p>
    @endif

</div>

<div class="form-group"><!-- passwd -->

    <label for="InputPassword" class="control-label">Mot de passe <span style="color:red">*</span></label>
    <input class="form-control" name="password" placeholder="Mot de passe" type="password" required>
    <small id="passwordHelp" class="form-text text-muted">Minimum 6 caractères.</small>

    @if ($errors->has('password'))
        <p class="form-text text-danger"> {{ $errors->first('password') }}</p>
    @endif

</div>

<div class="form-group"><!-- passwd_confirmation -->

    <label for="InputPassword2">Confirmer votre mot de passe <span style="color:red">*</span></label>
    <input class="form-control" id="InputPassword2" name="password_confirmation" placeholder="Mot de passe" type="password" required>

    @if ($errors->has('password_confirmation'))
        <p class="form-text text-danger"> {{ $errors->first('password_confirmation') }}</p>
    @endif

</div>