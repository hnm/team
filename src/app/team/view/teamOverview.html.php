<?php
	use team\bo\Team;
	use n2n\impl\web\ui\view\html\HtmlView;
use page\ui\PageHtmlBuilder;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$teams = $view->getParam('teams');
	
	$pageHtml = new PageHtmlBuilder($view);
	
	$detailLinkAvailable = $view->getParam('detailLinkAvailable', false, false);
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html');
?>
<?php $pageHtml->contentItems('top') ?>

<?php foreach ($teams as $team): $view->assert($team instanceof Team) ?>
	<article>
		<h2><?php $html->out($team->t($view->getN2nLocale())->getName()) ?></h2>
		<?php if (null !== ($descr = $team->t($view->getN2nLocale())->getDescription())): ?>
			<p><?php $html->out($descr)?></p>
		<?php endif ?>
		<?php $view->import('inc\teamMembers.html', array('teamMembers' => $team->getTeamMembers(), 
				'detailLinkAvailable' => $detailLinkAvailable)) ?>
	</article>
<?php endforeach ?>

<?php $pageHtml->contentItems('main')?>