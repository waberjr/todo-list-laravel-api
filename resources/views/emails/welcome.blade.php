<p>Olá {{ $user->first_name }}</p>
<p>Seja bem-vindo ao {{ config('app.name') }}. Por favor, verifiqu seu e-mail clicando no link abaixo.</p>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
    <tbody>
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                        <tr>
                            <td align="center">
                                <a href="{{ $verifyEmailLink }}" target="_blank">VERIFICAR E-MAIL</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<p>Ou, simplemente copie e cole o link abaixo em seu navegador: </p>
<p>{{ $verifyEmailLink }}</p>