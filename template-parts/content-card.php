<?php
/**
 * Template part for displaying post cards
 * Matches the original static site design
 *
 * @package Automatdo
 */

$categories = get_the_category();
$category_name = $categories ? $categories[0]->name : 'Uncategorized';
$category_slug = $categories ? $categories[0]->slug : 'uncategorized';

// Get icon based on category
$icon_svg = '';
switch ($category_slug) {
    case 'tpv-compliance':
    case 'tpv':
        $icon_svg = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M16 4L4 10v12l12 6 12-6V10L16 4z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 22v-6M12 14l4 2 4-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
        break;
    case 'guides':
        $icon_svg = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M4 24l7-7 5 5 12-12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M20 8h8v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
        break;
    case 'industry-news':
    case 'industry':
    default:
        $icon_svg = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <circle cx="16" cy="16" r="12" stroke="currentColor" stroke-width="2"/>
            <path d="M12 14l3 3 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
        break;
}
?>

<article class="post-card" data-category="<?php echo esc_attr($category_slug); ?>">
    <a href="<?php the_permalink(); ?>" class="post-card-link">
        <div class="post-card-image">
            <div class="post-card-icon">
                <?php echo $icon_svg; ?>
            </div>
        </div>
        <div class="post-card-content">
            <div class="post-meta">
                <span class="post-category"><?php echo esc_html($category_name); ?></span>
                <span class="post-read-time"><?php echo automatdo_reading_time(); ?> min</span>
            </div>
            <h3 class="post-card-title"><?php the_title(); ?></h3>
            <p class="post-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
        </div>
    </a>
</article>
