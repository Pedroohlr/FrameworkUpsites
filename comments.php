<?php
/**
 * Comments Template
 * 
 * @package FrameworkUpsites
 */

if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area mt-12 pt-12 border-t border-gray-200">

  <?php if (have_comments()): ?>

    <h2 class="text-3xl font-bold mb-8">
      <?php
      $comments_number = get_comments_number();
      printf(_n('%s Comentário', '%s Comentários', $comments_number, 'frameworkupsites'), number_format_i18n($comments_number));
      ?>
    </h2>

    <ol class="comment-list space-y-6 mb-8">
      <?php
      wp_list_comments(array(
        'style' => 'ol',
        'short_ping' => true,
        'avatar_size' => 50,
      ));
      ?>
    </ol>

    <?php the_comments_pagination(); ?>

  <?php endif; ?>

  <?php comment_form(); ?>

</div>