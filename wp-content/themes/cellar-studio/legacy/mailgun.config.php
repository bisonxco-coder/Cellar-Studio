<?php
/**
 * Mailgun configuration for `mailer.php`.
 *
 * IMPORTANT:
 * - Put your real Mailgun domain + API key here.
 * - Do NOT commit secrets to a public repo.
 */
return [
  // Example: "mg.yourdomain.com"
  'domain' => 'YOUR_MAILGUN_DOMAIN',

  // Example: "key-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
  'api_key' => 'YOUR_MAILGUN_API_KEY',

  // From address must be a verified Mailgun sender/domain mailbox
  'from_email' => 'postmaster@YOUR_MAILGUN_DOMAIN',
  'from_name' => 'Cellar Studio Website',

  // One or more recipients
  'to' => [
    'you@example.com',
  ],
];
