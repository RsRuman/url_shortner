## Leave Tracker Installation Guide
Please Follow the guideline to set up locally.

- Laravel 11 (php 8.3/8.2)

### Installation process after cloning from git

1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. set database mysql and update related things in .env
5. php artisan migrate
6. php artisan serve

### URL shortener explanation
For simplicity and performance, I choose Base62 Encoding to generate short URL.
It leverages the inherent order and uniqueness of database IDs and is simple to implement.

Here's the character set of Base62 Encoding,

`0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ`.

Below is the code to generate a unique string for short URLs

            public function base62_encode($number): string
            {
                $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $encoded          = '';

                while ($number > 0) {
                    $encoded = $characters[$number % $charactersLength] . $encoded;
                    $number  = floor($number / $charactersLength);
                }
        
                # Ensure the result is minimum 6 characters long
                while (strlen($encoded) < 6) {
                    $encoded .= $characters[random_int(0, $charactersLength - 1)];
                }
        
                return $encoded;
            }

1. Initial While Loop: This loop runs while the $number is greater than 0. The primary keys in MySQL start from 1.
The modulus operation ($number % $charactersLength) provides an index to fetch a character from the $characters string.
The fetched character is prepended to the $encoded string.
The number is then divided by the length of the character set and floored to update the number for the next iteration

2. Ensuring Minimum Length: The second while loop ensures that the resulting encoded string is at least 6 characters long by appending random characters from the character set if necessary.
