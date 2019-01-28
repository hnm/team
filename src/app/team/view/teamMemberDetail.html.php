<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use page\ui\PageHtmlBuilder;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$teamMember = $view->getParam('teamMember');
	
	$seTitle = null;
	$pageHtml = new PageHtmlBuilder($view);
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html');
?>
<?php $pageHtml->contentItems('top') ?>

<?php $view->import('inc\teamMember.html', array('teamMember' => $teamMember)) ?>

<?php $pageHtml->contentItems('main') ?>