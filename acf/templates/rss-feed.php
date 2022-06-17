<?php
/**
 * This is the file for the RSS Feeds ACF block type
 */

global $ctblock;
$ctblock = $block;

$t = time();
$feed_url = get_field('url');
$items_limit = get_field('items-limit');
$view_all_link = get_field('view-all-link');

//feed URL with timestamp
$feed_url_t = $feed_url . '?t=' . $t;

?>
<div class="acf-rss-feed">
    <ul>
        <?php
            if(function_exists('fetch_feed')){
                include_once(ABSPATH . WPINC . '/feed.php'); // Includes the necessary files
                $feed = fetch_feed($feed_url_t);  // URL to the feed you want to show
                $limit = $feed->get_item_quantity($items_limit); // How many items you wish to display
                $items = $feed->get_items(0, $limit);  // 0 is start and limit is noted above
            }

            if ($limit != 0):
                foreach ($items as $item):
        ?>
                <li>
                    <div class="animate__bottom-to-up">
                        <span class="date">
                            <?php echo $item->get_date('m/d/Y'); ?>
                        </span>

                        <a href="<?php echo $item->get_permalink(); ?>" class="title" target="_blank">
                            <h1><?php echo $item->get_title(); ?></h1>
                        </a>

                        <span class="readmore">
                            <a href="<?php echo $item->get_permalink(); ?>" target="_blank">See more</a>
                        </span>
                    </div>
                </li>
        <?php
                endforeach;
            endif;
        ?>
    </ul>
    <p class="view-all-link"><a href="<?php echo $view_all_link ?>" target="_blank">View All News</a></p>
</div>