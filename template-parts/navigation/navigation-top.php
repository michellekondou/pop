<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.2
 */
$menu_works = wp_get_nav_menu_object("WORKS");
$menu_iv = wp_get_nav_menu_object("I V & POP")
?>

<nav class="menu" id="side-menu">
    <input type="checkbox" id="small-nav" aria-hidden="true" tabindex="-1">
    <label class="small-screen" for="small-nav">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <div class="menu__items">
        <ul>
            <li class="menu__heading c"><span> <?php echo $menu_works->name; ?></span>
               <?php wp_nav_menu( array(
                    'theme_location' => 'categories'
                ) ); ?>
            </li>
            <li class="menu__heading about"><span> <?php echo $menu_iv->name; ?></span> 
                <?php wp_nav_menu( array(
                    'theme_location' => 'pages'
                ) ); ?>
            </li>
            <li class="language-nav mobile">
               <button type="button" class="language-switcher GR">GR</button>
                <button type="button" class="language-switcher EN">EN</button>
                <button type="button" class="language-switcher RM">RM</button> 
            </li>
        </ul>
        <?php var_dump( wp_get_nav_menu_object("I V & POP") ); ?>
    </div>
    
</nav>
<div class="language-nav desktop">
    <button type="button" class="language-switcher GR">GR</button>
    <button type="button" class="language-switcher EN">EN</button>
    <button type="button" class="language-switcher RM">RM</button>
</div>
<!-- #site-navigation -->
