<table class="table table-hover"<?php if ($this->url->admin) echo ' data-category-id="'.$category_id.'"' ?>>
	<thead class="forum-heading">
		<tr class="row">
			<th class="col-7" colspan="2">
				<h4><?php echo icon('fa-navicon').' '.$title ?></h4>
			</th>
			<th class="col-2"><h4><?php echo icon('fa-signal') ?><span class="hidden-xs"> <?php echo $this->lang('Statistiques') ?></span></h4></th>
			<th class="col-3"><h4><?php echo icon('fa-comment-o') ?><span class="hidden-xs"> <?php echo $this->lang('Dernier message') ?></span></h4></th>
			<?php if ($this->url->admin): ?>
			<th class="col-1 text-right">
				<?php echo $this->button_access($category_id, 'category') ?>
				<?php echo $this->button_update('admin/forum/categories/'.$category_id.'/'.url_title($title)) ?>
				<?php echo $this->button_delete('admin/forum/categories/delete/'.$category_id.'/'.url_title($title)) ?>
			</th>
			<?php endif ?>
		</tr>
	</thead>
	<tbody class="forum-content">
		<?php foreach ($forums as $forum): ?>
		<tr class="row"<?php if ($this->url->admin) echo ' data-forum-id="'.$forum['forum_id'].'"' ?>>
			<td class="col-1">
				<?php echo $forum['icon'] ?>
			</td>
			<td class="col-6">
				<h4><a href="<?php echo url('forum/'.$forum['forum_id'].'/'.url_title($forum['title'])) ?>"><?php echo $forum['title'] ?></a></h4>
				<?php if ($forum['description']) echo '<div>'.$forum['description'].'</div>' ?>
				<?php
				if (!empty($forum['subforums']) || $this->url->admin):
					echo '<ul class="subforums">';
					foreach ($forum['subforums'] as $subforum):
						echo '<li'.($this->url->admin ? ' data-forum-id="'.$subforum['forum_id'].'"' : '').'>'.
								($this->url->admin ? '<div class="pull-right">'.$this->button_update('admin/forum/'.$subforum['forum_id'].'/'.url_title($subforum['title'])).' '.$this->button_delete('admin/forum/delete/'.$subforum['forum_id'].'/'.url_title($subforum['title'])).'</div>' : '')
								.$subforum['icon'].' <a href="'.url('forum/'.$subforum['forum_id'].'/'.url_title($subforum['title'])).'">'.$subforum['title'].'</a>'.
							'</li>';
					endforeach;
					echo '</ul>';
				endif;
				?>
			</td>
			<td class="col-2">
			<?php
				if ($forum['url'])
				{
					echo 	$this->lang('<b>%d</b> redirection|<b>%d</b> redirections', $forum['redirects'], $forum['redirects']);
				}
				else
				{
					echo 	$this->lang('<b>%d</b> sujet|<b>%d</b> sujets', $forum['count_topics'], $forum['count_topics']).'<br />'.
							$this->lang('<b>%d</b> réponse|<b>%d</b> réponses', $forum['count_messages'], $forum['count_messages']);
				}
			?>
			</td>
			<td class="col-3">
				<?php if (!$forum['url']): ?>
				<?php if ($forum['last_title']): ?>
					<div><a href="<?php echo url('forum/topic/'.$forum['topic_id'].'/'.url_title($forum['last_title']).($forum['last_count_messages'] > $this->config->forum_messages_per_page ? '/page/'.ceil($forum['last_count_messages'] / $this->config->forum_messages_per_page) : '').'#'.$forum['last_message_id']) ?>"><?php echo icon('fa-comment-o').' '.str_shortener($forum['last_title'], 40) ?></a></div>
					<div><?php echo icon('fa-user').' '.($forum['user_id'] ? $this->user->link($forum['user_id'], $forum['username']) : '<i>'.$this->lang('Visiteur').'</i>').' '.icon('fa-clock-o').' '.time_span($forum['last_message_date']) ?></div>
				<?php else: ?>
					<?php echo $this->lang('Aucun message') ?>
				<?php endif; endif ?>
			</td>
			<?php if ($this->url->admin): ?>
			<td class="text-right">
					<?php echo $this->button_update('admin/forum/'.$forum['forum_id'].'/'.url_title($forum['title'])) ?>
					<?php echo $this->button_delete('admin/forum/delete/'.$forum['forum_id'].'/'.url_title($forum['title'])) ?>
			</td>
			<?php endif ?>
		</tr>
		<?php endforeach ?>
		<?php if (empty($forums)): ?>
		<tr>
			<td colspan="4" class="text-center"><h4><?php echo $this->lang('Aucun forum') ?></h4></td>
		</tr>
		<?php endif ?>
	</tbody>
</table>
