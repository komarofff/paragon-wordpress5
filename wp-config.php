<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', "paragon" );

/** Имя пользователя MySQL */
define( 'DB_USER', "root" );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', "root" );

/** Имя сервера MySQL */
define( 'DB_HOST', "localhost" );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_NIN^~81IM3#lm,O9^Tk@=7U@5>`uso4@FmzQa7l|hgJo!!Fyf}(r<%%HB/4)Dg0' );
define( 'SECURE_AUTH_KEY',  'lU`y5wvZ#=~<^3rV/{wNLm0Qv`UzWQ>zhDQc]C;Oiiq.!*XIh,2FukcX>Rd@(I7*' );
define( 'LOGGED_IN_KEY',    'my`<i!pF[My}D$G4KS8pLYaWxl` cb8z1xM~vzv!`tq3BOew<b8w&QX47$ZILxg2' );
define( 'NONCE_KEY',        'qlDQ(8y$ o8WP,{^+fm;%beu7XG4&1I7H6Msp9wuwz+]KIM20lAaD9ZUE|,^#`1^' );
define( 'AUTH_SALT',        '@n%bL*I,>We[4Bgq%>*NM9HvW+=vlQ}G*Dvd;&< *xkT(+6Prqg*m+E.DGG5qp9}' );
define( 'SECURE_AUTH_SALT', 'hG:KC,XxoIZ+#yTce$u.lsRYXrVA)Y`tv:X;8x5hpo[NwVqlH51WNt>U]8wKC%]0' );
define( 'LOGGED_IN_SALT',   ')W()2q&>Tve<+:KiRkka/n+*v8N ji!W{+}vLfD-;N$iG><)658d#P7~q%U;,yrk' );
define( 'NONCE_SALT',       'rXv)ft|ABfcU64=L%G&y-%C~*26z<a*1_ *[R-3ADn6<vc:3Z1<n|@7Ej;4iA2%(' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );



/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */

define('WP_POST_REVISIONS', true );

//define('WP_POST_REVISIONS', false);
define('AUTOSAVE_INTERVAL', 60*60*60*24*365);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
