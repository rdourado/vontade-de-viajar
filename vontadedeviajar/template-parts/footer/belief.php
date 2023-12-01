<?php
/**
 * Short nice message for visitors.
 *
 * @package vdv
 */

namespace RDourado\VdV;

$heading = __( 'Em que <span>acreditamos</span>', 'vdv' );

$default_belief_1 = __( 'Viajar pode ser uma experiência transformadora para quem tem olhar criativo e interpreta o que vê pelo mundo', 'vdv' );
$default_belief_2 = __( 'Buscar inspiração nas artes, no cinema e na música torna a viagem mais divertida e criativa', 'vdv' );
$default_belief_3 = __( 'Viajar é a melhor maneira de criar memórias especiais com quem a gente ama, fazer novos amigos e conhecer outras culturas', 'vdv' );

$belief_1 = get_theme_mod( 'belief_1', $default_belief_1 );
$belief_2 = get_theme_mod( 'belief_2', $default_belief_2 );
$belief_3 = get_theme_mod( 'belief_3', $default_belief_3 );

?>

<aside class="vdv-belief">
	<h4 class="vdv-belief__heading"><?php echo ( $heading ); ?></h4>
	<ol class="vdv-belief__wrap">
		<li class="vdv-belief__step"><?php echo esc_html( $belief_1 ); ?></li>
		<li class="vdv-belief__step"><?php echo esc_html( $belief_2 ); ?></li>
		<li class="vdv-belief__step"><?php echo esc_html( $belief_3 ); ?></li>
	</ol>
</aside>
