<?php 

class User 
{
    private string $username;

    private string $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function serialize() 
    {
        return [
            'username' => $this->username
        ];
    }
}

$user = new User('toto', 'toto@gmail.com');

$user_serialized = serialize($user);

$user_deserialized = unserialize($user_serialized);


echo '<pre>' . var_export($user, true) . '</pre>';
echo '<hr>';

echo '<pre>' . var_export($user_serialized, true) . '</pre>';
echo '<hr>';

echo '<pre>' . var_export($user_deserialized, true) . '</pre>';

