# Limudnaim test assignment

The site was built using laravel + breeze + vite + vue + inertia. I modified several methods from Laravel Breeze for authentication by adding the necessary fields (image, phone). Created database migrations for Mysql.

- A Vue index page displays all registered users.

- Added authentication data for external API services to the .ENV and /config/services.php files.

- To send email, I created a Service "Mailchimp" with the “send” method. After the user registers, an Event is created, and it is monitored by a Listener who sends a welcome letter via Service.

- To work with the Pixabay image service, method "getPixabayImages" was created in ProfileController + a Vue component was written for multiple use in registration and profile editing forms.

- The site uses one Model - "User", described by PHPDoc and containing two methods for updating the user's image from different sources.
