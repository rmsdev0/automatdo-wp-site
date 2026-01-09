<?php
/**
 * Blog Post Import Script
 *
 * Run this once by visiting: /wp-admin/themes.php?import_posts=1
 *
 * @package Automatdo
 */

// Hook into admin_init to run import
add_action('admin_init', 'automatdo_maybe_import_posts');

function automatdo_maybe_import_posts() {
    if (!isset($_GET['import_posts']) || $_GET['import_posts'] !== '1') {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    // Check if already imported
    if (get_option('automatdo_posts_imported')) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-warning"><p>Posts have already been imported. Delete this option in the database to re-import.</p></div>';
        });
        return;
    }

    $posts = automatdo_get_blog_posts();
    $imported = 0;

    // Create category if it doesn't exist
    $category_id = wp_create_category('TPV & Compliance');

    foreach ($posts as $post_data) {
        // Check if post already exists
        $existing = get_page_by_path($post_data['slug'], OBJECT, 'post');
        if ($existing) {
            continue;
        }

        // Get or create category
        $cat_id = get_cat_ID($post_data['category']);
        if (!$cat_id) {
            $cat_id = wp_create_category($post_data['category']);
        }

        // Create the post
        $post_id = wp_insert_post(array(
            'post_title'    => $post_data['title'],
            'post_content'  => $post_data['content'],
            'post_excerpt'  => $post_data['description'],
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_name'     => $post_data['slug'],
            'post_date'     => $post_data['date'] . ' 12:00:00',
            'post_category' => array($cat_id),
        ));

        if ($post_id && !is_wp_error($post_id)) {
            // Store author info as post meta
            update_post_meta($post_id, '_automatdo_author_role', $post_data['authorRole']);
            $imported++;
        }
    }

    update_option('automatdo_posts_imported', true);

    add_action('admin_notices', function() use ($imported) {
        echo '<div class="notice notice-success"><p>Successfully imported ' . $imported . ' blog posts!</p></div>';
    });
}

function automatdo_get_blog_posts() {
    return array(
        array(
            'title' => 'The Complete Guide to TPV Verification for Energy Retailers',
            'description' => 'Everything you need to know about third-party verification in deregulated energy markets. From regulatory requirements to implementation best practices, this comprehensive guide covers TPV compliance across all major states.',
            'date' => '2024-12-15',
            'category' => 'TPV & Compliance',
            'author' => 'Automatdo Team',
            'authorRole' => 'Compliance & Operations',
            'slug' => 'complete-guide-tpv-verification',
            'content' => '<!-- wp:paragraph -->
<p>Third-party verification (TPV) is a critical compliance requirement for energy retailers operating in deregulated markets. This guide covers everything you need to know about implementing and maintaining compliant TPV processes.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>What is TPV Verification?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Third-party verification is an independent confirmation process required when customers enroll with a new energy supplier. The TPV call verifies that the customer:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>Understands they are switching energy providers</li>
<li>Acknowledges the terms of their new service agreement</li>
<li>Confirms their identity and service address</li>
<li>Authorizes the enrollment to proceed</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>TPV exists to protect consumers from unauthorized enrollments, often called "slamming" in the industry.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Why TPV Matters for Your Business</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Beyond compliance, effective TPV processes directly impact your bottom line:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Enrollment Completion Rates</strong>: A smooth TPV experience means fewer customers abandon the process mid-verification. Industry averages show 15-25% drop-off rates, but optimized processes can achieve under 10%.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Regulatory Standing</strong>: PUC violations for TPV non-compliance can result in fines ranging from $1,000 to $25,000 per occurrence, plus potential license suspension.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Customer Experience</strong>: Your TPV call is often the customer\'s first interaction with your company after signing up. A professional, efficient call sets the tone for the relationship.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>State-by-State Requirements</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>TPV requirements vary significantly by state. Here\'s an overview of the major deregulated markets:</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Texas (PUCT)</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Texas has some of the most detailed TPV requirements in the country:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>All TPV calls must be recorded and retained for 2 years</li>
<li>Specific language must be used for key disclosures</li>
<li>Customer must verbally confirm each required element</li>
<li>TPV vendor must be independent from the energy retailer</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Ohio (PUCO)</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ohio requires:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>Independent third-party verification</li>
<li>Recording retention for minimum of 2 years</li>
<li>Specific disclosure of cancellation rights</li>
<li>Confirmation of customer\'s current utility</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Pennsylvania (PUC)</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Pennsylvania emphasizes consumer protection:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>Clear disclosure of all rates and terms</li>
<li>Confirmation that customer was not misled</li>
<li>Recording retention requirements</li>
<li>Specific script elements for door-to-door sales</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Common TPV Compliance Mistakes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>After reviewing thousands of TPV calls, these are the most frequent compliance issues we see:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li><strong>Incomplete Script Adherence</strong>: Agents skipping or paraphrasing required disclosures</li>
<li><strong>Leading Questions</strong>: Asking "You understand that, right?" instead of open-ended confirmations</li>
<li><strong>Insufficient Customer Confirmation</strong>: Accepting "mm-hmm" instead of clear "yes" responses</li>
<li><strong>Recording Quality Issues</strong>: Poor audio quality that could be challenged in disputes</li>
<li><strong>Timing Violations</strong>: Conducting TPV outside of allowed hours</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>The Role of AI in TPV</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Modern AI voice agents are transforming TPV verification by ensuring 100% script compliance, providing consistent customer experience 24/7, and reducing costs while maintaining quality.</p>
<!-- /wp:paragraph -->'
        ),
        array(
            'title' => 'AI vs Human TPV Agents: A Complete Cost Comparison',
            'description' => 'A detailed breakdown of the true costs of human vs AI-powered TPV verification, including hidden costs, scalability factors, and ROI analysis.',
            'date' => '2024-12-20',
            'category' => 'TPV & Compliance',
            'author' => 'Automatdo Team',
            'authorRole' => 'Business Development',
            'slug' => 'ai-vs-human-tpv-cost-comparison',
            'content' => '<!-- wp:paragraph -->
<p>When evaluating TPV solutions, cost is often the primary consideration. But comparing human agents to AI requires looking beyond hourly rates to understand the true total cost of ownership.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>The True Cost of Human TPV Agents</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Human TPV agents appear straightforward to cost out, but there are many hidden expenses that add up quickly.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Direct Costs</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Hourly wages: $12-18/hour for US-based agents</li>
<li>Benefits and taxes: Add 25-35% to base wages</li>
<li>Training costs: $500-2,000 per agent</li>
<li>Supervision and QA: 1 supervisor per 10-15 agents</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Hidden Costs</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Turnover: Industry averages 30-50% annually</li>
<li>Idle time: Agents paid during low-volume periods</li>
<li>Error remediation: Compliance violations and re-calls</li>
<li>Technology infrastructure: Telephony, recording, CRM</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>AI TPV: Predictable, Scalable Costs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>AI-powered TPV offers a fundamentally different cost structure with usage-based pricing, zero idle time costs, and no training or turnover expenses.</p>
<!-- /wp:paragraph -->'
        ),
        array(
            'title' => 'Texas TPV Compliance Requirements: What Energy Retailers Need to Know',
            'description' => 'Complete guide to PUCT TPV requirements for energy retailers operating in Texas, including specific script requirements and recording retention rules.',
            'date' => '2024-12-22',
            'category' => 'TPV & Compliance',
            'author' => 'Automatdo Team',
            'authorRole' => 'Compliance & Operations',
            'slug' => 'texas-tpv-compliance-requirements',
            'content' => '<!-- wp:paragraph -->
<p>Texas has one of the most competitive deregulated energy markets in the country, and with that competition comes strict oversight from the Public Utility Commission of Texas (PUCT). Understanding and adhering to TPV requirements is essential for any REP operating in the state.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>PUCT TPV Requirements Overview</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The PUCT mandates specific TPV procedures for all residential customer enrollments. These requirements are designed to prevent slamming and ensure customers fully understand their enrollment decisions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Required Script Elements</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Customer name and service address verification</li>
<li>Clear identification of the REP the customer is enrolling with</li>
<li>Disclosure of contract terms and pricing</li>
<li>Confirmation of authorization to switch providers</li>
<li>Explanation of cancellation rights</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Recording Requirements</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All TPV calls must be recorded and retained for a minimum of 2 years. Recordings must be made available to the PUCT upon request within 3 business days.</p>
<!-- /wp:paragraph -->'
        ),
        array(
            'title' => 'Ohio TPV Compliance Requirements: PUCO Guidelines Explained',
            'description' => 'Everything energy retailers need to know about Ohio PUCO TPV requirements, from verification procedures to record-keeping obligations.',
            'date' => '2024-12-25',
            'category' => 'TPV & Compliance',
            'author' => 'Automatdo Team',
            'authorRole' => 'Compliance & Operations',
            'slug' => 'ohio-tpv-compliance-requirements',
            'content' => '<!-- wp:paragraph -->
<p>Ohio\'s deregulated energy market is overseen by the Public Utilities Commission of Ohio (PUCO), which has established specific requirements for third-party verification of customer enrollments.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>PUCO TPV Framework</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The PUCO requires all competitive retail electric service (CRES) providers to conduct independent third-party verification for customer enrollments. This applies to both residential and small commercial customers.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Key Requirements</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Independent verification by a party not involved in the sale</li>
<li>Customer confirmation of identity and authorization</li>
<li>Clear disclosure of rates, terms, and cancellation rights</li>
<li>Recording retention for minimum 2 years</li>
</ul>
<!-- /wp:list -->'
        ),
        array(
            'title' => 'How to Reduce TPV Drop-Off Rates: Proven Strategies',
            'description' => 'Practical strategies to reduce customer drop-off during TPV verification calls, improving enrollment completion rates and revenue.',
            'date' => '2024-12-28',
            'category' => 'Guides',
            'author' => 'Automatdo Team',
            'authorRole' => 'Customer Success',
            'slug' => 'reduce-tpv-drop-off-rates',
            'content' => '<!-- wp:paragraph -->
<p>TPV drop-off rates directly impact your bottom line. Every customer who abandons during verification represents lost revenue and wasted acquisition spend. Here are proven strategies to minimize drop-offs.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Understanding Why Customers Drop Off</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Before solving the problem, we need to understand its root causes:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>Long wait times</strong>: Customers lose patience waiting for a TPV agent</li>
<li><strong>Confusing scripts</strong>: Complex language leads to customer hesitation</li>
<li><strong>Call length</strong>: Verification calls that drag on too long</li>
<li><strong>Technical issues</strong>: Poor audio quality or dropped calls</li>
<li><strong>Buyer\'s remorse</strong>: Time to reconsider during the verification process</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Strategies to Reduce Drop-Offs</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>1. Minimize Wait Times</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The longer a customer waits, the more likely they are to hang up. AI-powered TPV eliminates wait times entirely by handling calls immediately.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>2. Optimize Script Flow</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Review your TPV script for unnecessary complexity. Every second of the call should serve a purpose.</p>
<!-- /wp:paragraph -->'
        ),
        array(
            'title' => 'The Future of TPV: How AI Voice Technology is Transforming Verification',
            'description' => 'Exploring how AI voice agents are revolutionizing third-party verification with better compliance, lower costs, and improved customer experience.',
            'date' => '2025-01-02',
            'category' => 'Industry News',
            'author' => 'Automatdo Team',
            'authorRole' => 'Product Team',
            'slug' => 'future-of-tpv-ai-voice-technology',
            'content' => '<!-- wp:paragraph -->
<p>The TPV industry is undergoing a fundamental transformation. AI voice technology is moving from experimental to essential, offering capabilities that traditional call centers simply cannot match.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>The Current State of TPV</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Traditional TPV relies on human agents reading scripts, manually recording responses, and making real-time compliance decisions. This model has served the industry for decades, but its limitations are becoming increasingly apparent.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How AI is Changing the Game</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>100% Compliance Consistency</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>AI agents never skip script elements, never paraphrase required disclosures, and never make compliance shortcuts. Every call follows the exact approved process.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>24/7 Availability</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Customers can complete TPV verification at any hour, eliminating scheduling friction and improving completion rates.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Instant Scalability</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>AI systems can handle volume spikes without advance notice, eliminating the staffing challenges that plague traditional call centers.</p>
<!-- /wp:paragraph -->'
        ),
    );
}
