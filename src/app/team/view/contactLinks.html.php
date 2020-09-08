<?php 
	use n2n\impl\web\ui\view\html\HtmlView;
	use page\ui\PageHtmlBuilder;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use team\bo\TeamMember;

	$view = HtmlView::view($this);
	$html = HtmlView::html($this);
	$request = HtmlView::request($view);
	$locale = $request->getN2nLocale();
	
	$members = $view->getParam('teamMembers');
	
	$pageHtml = new PageHtmlBuilder($view);
	$ckeHtml = new CkeHtmlBuilder($view);

	$titlePrefix = '';
	
	$html->meta()->addMeta(['name' => 'robots', 'content' => 'noindex, nofollow'], 'name');
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html', array('applyTitle' => false, 'hasDetailNavi' => false, 
			'applyBodyHidden' => true));
?>

<dl class="row">
	<?php foreach ($members as $member) : $view->assert($member instanceof TeamMember)?>
		<dt class="col-sm-3 col-lg-2"><?php $html->out($member->getFullName())?></dt>
		<dd class="col-sm-9 col-lg-10"><?php $html->out($member->getPathPart() . '/' . $member->getCode())?></dd>
	<?php endforeach ?>
</dl>