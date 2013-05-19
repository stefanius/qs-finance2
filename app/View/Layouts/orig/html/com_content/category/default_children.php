<?php
/**
 * @version		$Id: default_children.php 17017 2010-05-13 10:48:48Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$templateparams =$this->App->getTemplate(true)->params;

if ($templateparams->get('html5') != 1) :
	require(JPATH_BASE.'/components/com_content/views/category/tmpl/default_children.php');
	//evtl. ersetzen durch JPATH_COMPONENT.'/views/...'
	return;
endif;

$class = ' class="first"';
?>

<?php if (count($this->children[$this->category->id]) > 0) :?>

	<ul>
	<?php foreach($this->children[$this->category->id] as $id => $child) : ?>
		<?php
		if ($this->request->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) :
			if (!isset($this->children[$this->category->id][$id + 1])) :
				$class = ' class="last"';
			endif;
		?>
		<li<?php echo $class; ?>>
			<?php $class = ''; ?>
				<span class="item-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
					<?php echo $this->escape($child->title); ?></a>
				</span>
				<?php if ($this->request->params->get('show_subcat_desc') == 1) :?>
				<?php if ($child->description and $this->request->params->get('show_description')!=0 ) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $child->description); ?>
					</div>
				<?php endif; ?>
				<?php endif; ?>
				<?php if ($child->getNumItems()==true) : ?>
				<dl>
					<dt>
						<?php echo JText::_('COM_CONTENT_NUM_ITEMS') ; ?>
					</dt>
					<dd>
						<?php echo $child->getNumItems(true); ?>
					</dd>
				</dl>
				<?php endif ; ?>

				<?php if (count($child->getChildren()) > 0 ) :
					$this->children[$child->id] = $child->getChildren();
					$this->category = $child;
					$this->maxLevel--;
					if ($this->maxLevel != 0) :
						echo $this->loadTemplate('children');
					endif;
					$this->category = $child->getParent();
					$this->maxLevel++;
				endif; ?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
