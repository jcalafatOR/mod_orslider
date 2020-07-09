<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2019 - 2020 openROOM. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$orSlider_list = array();
for($i=1; $i<=10; $i++)
{
	if($params->get('s'.$i.'_activar') == 1)
	{
		$tmp_arraySlider = array();
		$tmp_arraySlider['img'] = $params->get('s'.$i.'_image');
		$tmp_arraySlider['content'] = $params->get('s'.$i.'_content');
		$orSlider_list[] = $tmp_arraySlider;
	}
}
$orSliderClases = explode(" ", $moduleclass_sfx);
$orSliderClases = implode(".", array_filter($orSliderClases, "strlen"));
$orSliderClases = !empty($orSliderClases) ? ".".$orSliderClases : "";
$orSliderTimer = empty($params->get('timer')) ? 0 : $params->get('timer');
$orSliderSpeed = empty($params->get('speed')) ? 350 : $params->get('speed');

if(count($orSlider_list) > 0) { ?>
<style>
	.or_slider<?php echo $orSliderClases; ?> > .or_slider_content > .or_slider_contentBlocks > [class^="or_slider_"]
	{
		background-size : cover;
		background-position: center;
		background-repeat: no-repeat;
	}
	<?php
		$or_tmpCuerrentLang = JFactory::getLanguage();
        $or_tmpDefaultLang = JComponentHelper::getParams('com_languages')->get('site');
		$orsliderRouteFix = $or_tmpCuerrentLang->getTag() != $or_tmpDefaultLang ? "../" : "";
		foreach($orSlider_list as $or_slider_id => $or_slider_content) {
			if(JFile::exists(substr($or_slider_content['img'],0,-3).'webp'))
			{ ?>
				.or_slider<?php echo $orSliderClases; ?> > .or_slider_content > .or_slider_contentBlocks > .or_slider_<?php echo ($or_slider_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.substr($or_slider_content['img'],0,-3).'webp';?>); }
				.isSafari .or_slider<?php echo $orSliderClases; ?> > .or_slider_content > .or_slider_contentBlocks > .or_slider_<?php echo ($or_slider_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_slider_content['img'];?>); }
				@supports (-webkit-touch-callout: default) {
					.or_slider<?php echo $orSliderClases; ?> > .or_slider_content > .or_slider_contentBlocks > .or_slider_<?php echo ($or_slider_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_slider_content['img'];?>); }
				}
			
			<?php } else { ?>
				.or_slider<?php echo $orSliderClases; ?> > .or_slider_content > .or_slider_contentBlocks > .or_slider_<?php echo ($or_slider_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_slider_content['img'];?>); }
			<?php } ?>			
		
	<?php } ?>
</style>
<?php } ?>
<div class="or_slider <?php echo $moduleclass_sfx; ?>"  >
	<?php if(!empty($module->content)){ ?>
	<div class="or_blockwidth">
		<?php echo $module->content; ?>
	</div>
	<?php }
	if(count($orSlider_list) > 0) { ?>
	<div class="or_slider_content">
		<div class="or_slider_contentBlocks" rel-timer="<?php echo $orSliderTimer; ?>" rel-speed="<?php echo $orSliderSpeed; ?>">
		<?php foreach($orSlider_list as $or_slider_id => $or_slider_content) { ?>
			<div class="or_slider_<?php echo ($or_slider_id+1); ?>" rel="<?php echo ($or_slider_id+1); ?>" >
				<?php echo $or_slider_content['content']; ?>
			</div>
		<?php } ?>
		</div>
		<div class="or_slider_move"><span class="or_prev"></span><span class="or_next"></span></div>
	</div>
	<?php } ?>
</div>
