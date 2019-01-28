<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use page\ui\PageHtmlBuilder;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);

	$teamMembers = $view->getParam('teamMembers');
	$pageHtml = new PageHtmlBuilder($view);
	
	$detailLinkAvailable = $view->getParam('detailLinkAvailable', false, false);
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html');
?>
<?php $pageHtml->contentItems('top') ?>

<?php $view->import('inc\teamMembers.html', array('teamMembers' => $teamMembers, 'detailLinkAvailable' => $detailLinkAvailable)) ?>

<?php $pageHtml->contentItems('main')?>