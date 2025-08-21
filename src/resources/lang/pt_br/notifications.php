<?php
// resources/lang/pt_BR/notifications.php
return [
    'common' => [
        'greeting' => 'Prezado(a) :name,',
            'salutation' => 'Atenciosamente,',
            'action' => 'Acessar',
            'footer_notice' => 'Se você não reconhece esta solicitação, por favor desconsidere este e-mail.',
        ],

    'account' => [
        'welcome' => [
            'subject' => 'Bem-vindo(a) à plataforma',
            'intro' => 'Sua conta foi criada com sucesso.',
            'details' => 'Você já pode acessar a plataforma utilizando seu e-mail: :email.',
            'cta' => 'Acessar a plataforma',
        ],
        'verify' => [
            'subject' => 'Confirme seu endereço de e-mail',
            'intro' => 'Para concluir seu cadastro, solicitamos a confirmação do seu endereço de e-mail.',
            'details' => 'Clique no botão abaixo para verificar seu e-mail. Este link expira em breve por motivos de segurança.',
            'cta' => 'Confirmar e-mail',
        ],
        'password_reset' => [
            'subject' => 'Instruções para redefinição de senha',
            'intro' => 'Recebemos uma solicitação para redefinir a senha da sua conta.',
            'details' => 'Se você fez esta solicitação, utilize o botão abaixo para continuar. O link expira em breve.',
            'cta' => 'Redefinir senha',
        ],
        'security_login_alert' => [
            'subject' => 'Novo acesso detectado',
            'intro' => 'Identificamos um novo acesso à sua conta.',
            'details' => 'Data/Hora: :datetime — IP: :ip — Agente: :agent',
            'cta' => 'Gerenciar segurança da conta',
        ],
    ],
];
