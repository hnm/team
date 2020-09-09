<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use page\ui\PageHtmlBuilder;
use team\bo\Location;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$locations = $view->getParam('locations');
	
	$pageHtml = new PageHtmlBuilder($view);
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html');
?>

<?php $pageHtml->contentItems('main')?>

<?php foreach ($locations as $location): $view->assert($location instanceof Location) ?>
	<article>
		<h2><?php $html->out($location->getName()) ?></h2>
		<p>
			<?php $html->escBr($location->getAddressStr())?>
		</p>
	</article>
<?php endforeach ?>