<?php

global $wpdb;

$query = "SELECT ID from $wpdb->users";
$author_ids = $wpdb->get_results($query);
$users = array();




get_header();
?>

<main class="faq">
    <div class="container faq__container">
        <div class="row ">
            <div>
                <h1>Frequently Asked Questions</h1>
                    <ul>
                        <li>1. Soon</li>
                          <p></p>
                        <li>2.</li>
                          <p></p>
                        <li>3.</li>
                          <p></p>
                        <li>4.</li>
                          <p></p>
                        <li>5.</li>
                          <p></p>
                    </ul>
            </div>
        </div>
    </div>
</main>







<?php 
get_footer();