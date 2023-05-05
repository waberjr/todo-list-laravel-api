<p>Olá {{ $user->first_name }}</p>
<p>Você requisitou a alteração de senha da sua conta {{ config('app.name') }}. Por favor, clique no link abaixo para fazer a alteração de senha.</p>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
    <tbody>
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                        <tr>
                            <td align="center">
                                <a href="{{ $resetPasswordLink }}" target="_blank">REDEFINIR SENHA</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<p>Ou, simplemente copie e cole o link abaixo em seu navegador: </p>
<p>{{ $resetPasswordLink }}</p>

<p>Por favor, ignore este email se você não requisitou alteração de senha</p>