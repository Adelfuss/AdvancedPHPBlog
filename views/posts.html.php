<?php foreach ($posts as $post): ?>
	<div>
		<h2>
			<a href="/post/<?=$post['id']?>"><?=$post['title']?></a>
		</h2>
		<p>
			<?=$post['preview']?>
		</p>
	</div>
<?php endforeach; ?>