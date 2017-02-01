<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/actions_remisetotal.class.php
 * \ingroup remisetotal
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class Actionsremisetotal
 */
class Actionsremisetotal
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct()
	{
		global $langs;
		
		$langs->load('remisetotal@remisetotal');
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	function doActions($parameters, &$object, &$action, $hookmanager)
	{
		/*$error = 0; // Error counter
		$myvalue = 'test'; // A result value

		print_r($parameters);
		echo "action: " . $action;
		print_r($object);

		if (in_array('somecontext', explode(':', $parameters['context'])))
		{
		  // do something only for the context 'somecontext'
		}

		if (! $error)
		{
			$this->results = array('myreturn' => $myvalue);
			$this->resprints = 'A text to show';
			return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}*/
	}

	function addMoreActionsButtons($parameters, &$object, &$action, $hookmanager)
	{
		global $conf;
		
		switch ($parameters['currentcontext']) 
		{
			case 'propalcard':
				if ($conf->global->REMISETOTAL_ADD_BUTTON_ON_PROPAL) $this->_printForm($conf, $object, $action, '/comm/propal/card.php?id='.$object->id);
				break;
			case 'ordercard':
				if ($conf->global->REMISETOTAL_ADD_BUTTON_ON_ORDER) $this->_printForm($conf, $object, $action, '/commande/card.php?id='.$object->id);
				break;
			case 'invoicecard':
				if ($conf->global->REMISETOTAL_ADD_BUTTON_ON_INVOICE) $this->_printForm($conf, $object, $action, '/compta/facture.php?id='.$object->id);
				break;
		}
		
	}
	
	private function _printForm(&$conf, &$object, $action, $url)
	{
		global $langs;
		global $db;
		global $object;
		dol_include_once('/comm/propal/class/propal.class.php');
		dol_include_once('/commande/class/commande.class.php');
		dol_include_once('/compta/facture/class/facture.class.php');
		dol_include_once('/customfields/lib/customfields_aux.lib.php');
		$customfields = customfields_fill_object($object, null, $langs);

		$sumqtypsc = 0 ;
		$sumqtypsf = 0 ;
		
		// functionne qd propal is validate print_r($object->customfields->cf_nombre_d_invites);

		foreach($object->lines as $l) {
			
			if(preg_match('`^A1`', $l->ref)) {
				$sumqtypsf += $l->qty;
				$refsumpsf = $l->qty;
			}			

			if(preg_match('`^A2`', $l->ref)) {
				$sumqtypsc += $l->qty;
				$refsumpsc = $l->qty;
			}			
		}

		if ($object->statut == 0 && $object->element == 'propal') { 
		$reqsqlta = $db->query("SELECT SUM(dpd.qty) as sum FROM doli_".$object->element."det as dpd, `doli_product` as dp WHERE dpd.fk_".$object->element." = '".$object->id."' and dpd.fk_product = dp.rowid and dp.ref like 'A%' and dp.ref not like 'AR%'");
		$sommealimentaire = $reqsqlta->fetch_assoc();
		$varsommealimentaire = $sommealimentaire['sum'];
		$reqtotalinvit = $db->query("SELECT piece_pers as nbi , nombre_d_invites as nbp FROM doli_".$object->element."_customfields where fk_".$object->element." = '".$object->id."'");
		$fetchtotalinvit = $reqtotalinvit->fetch_assoc();
		$totalinvit = $fetchtotalinvit['nbi']*$fetchtotalinvit['nbp'];
		$nbpiece = $fetchtotalinvit['nbp'];

		?>
		<div class="divButAction" style="width: 100%;text-align: left;margin-bottom: -57px;" >
			<div style="background:#f8f8f8;width:30%;font-size: 13px;padding:5px;font-weight:bold;border:1px solid #9CACBB;border-radius:5px;"><u>Compteur Quantité Alimentaire ( <?php echo $sommealimentaire['sum'] ;?> / <?php echo $totalinvit ;?></u> )
			   <div style="margin: 14px;">
				<table width="100%"><tr>
				<td width='50%'><a>Quantité piéces froides</td>
				<td width='20%'><?php echo $sumqtypsf;?></a></td>
				<td rowspan="2"><a id="modifqtyalimentaire" class="butAction" href="#">Modifier</a></td>
				</tr><tr>
				<td><a>Quantité piéces chaude </td><td><?php echo $sumqtypsc;?></a></td>
				</tr></table>
				
			   </div>
			</div>
			
		</div>
		<!--div class="inline-block divButAction" >
			<a id="modifqtyalimentaire" class="butAction" href="#"><?php echo $langs->trans('modifqtyalimentaire'); ?> ( compteur pièce alimentaire <span style="color: blue;"> <?php echo $sommealimentaire['sum'] ;?></span> / <?php echo $totalinvit ;?> )</a>
		</div-->
		<div class="inline-block divButAction">
			<a id="remisetotalButton" class="butAction" href="#"><?php echo $langs->trans('remisetotalLabelButton'); ?></a>
		</div>
		<?php } ?>

	 	<script type="text/javascript">
			$(document).ready(function() 
			{
				function promptRemiseTotal(url_to, url_ajax)
				{
					var total = "<?php echo !empty($conf->global->REMISETOTAL_B2B) ? price($object->total_ht) : price($object->total_ttc); ?>";
				    $( "#dialog-prompt-remisetotal" ).remove();
				    $('body').append('<div id="dialog-prompt-remisetotal"><input id="remisetotal-title" size=30 value="'+total+'" /></div>');
				    
                    $('#remisetotal-title').select();
				    $( "#dialog-prompt-remisetotal" ).dialog({
                    	resizable: false,
                        height:140,
                        modal: true,
                        title: "<?php echo !empty($conf->global->REMISETOTAL_B2B) ? $langs->transnoentitiesnoconv('remisetotalNewTotalHT') : $langs->transnoentitiesnoconv('remisetotalNewTotalTTC'); ?>",
                        buttons: {
                            "Ok": function() {
                                $.ajax({
                                	url: url_ajax
                                	,data: {
                                		fk_object: <?php echo (int) $object->id; ?>
                                		,element: "<?php echo $object->element; ?>"
                                		,newTotal: $(this).find('#remisetotal-title').val()
                                	}
                                }).then(function (data) {
                                	document.location.href=url_to;
                                });

                                $( this ).dialog( "close" );
                            },
                            "<?php echo $langs->trans('Cancel') ?>": function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    }).keypress(function(e) {
                    	if (e.keyCode == $.ui.keyCode.ENTER) {
					          $('.ui-dialog').find('button:contains("Ok")').trigger('click');
					    }
                    });
                    
				}

				function promptqtyalim(url_to, url_ajax)
				{
				    var total = "<?php echo !empty($conf->global->REMISETOTAL_B2B) ? price($object->total_ht) : price($object->total_ttc); ?>";
				    $( "#dialog-prompt-remisetotal" ).remove();
				    $('body').append('<div id="dialog-prompt-remisetotal"> <table width="100%"> \
							<tr><td width="50%"><label>Pièces froides </label></td><td><input id="qtypcef" size=10 value="<?php echo $refsumpsf; ?>" /></td></tr> \
							<tr><td width="50%"><label>Pièces Chaudes </label></td><td><input id="qtypcec" size=10 value="<?php echo $refsumpsc; ?>" /></td></tr> \
						      </table></div>');
				    
                    		    $('#qtyalim').select();
				    $( "#dialog-prompt-remisetotal" ).dialog({
                    			resizable: false,
                        		height:200,
                        		modal: true,
                        		title: "Modification des quantités",
                        		buttons: {
                            		"Ok": function() {
                                		$.ajax({
                                		url: url_ajax
                                		,data: {
                                			fk_object: <?php echo (int) $object->id; ?>
                                			,element: "<?php echo $object->element; ?>"
                                			,qtypcef: $(this).find('#qtypcef').val()
							,qtypcec: $(this).find('#qtypcec').val()
                                		}
                                		}).then(function (data) {
                                			document.location.href=url_to;
                                		});

                                	$( this ).dialog( "close" );
                            },
                            "<?php echo $langs->trans('Cancel') ?>": function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    }).keypress(function(e) {
                    	if (e.keyCode == $.ui.keyCode.ENTER) {
					          $('.ui-dialog').find('button:contains("Ok")').trigger('click');
					    }
                    });
                    
				}
				
				$('a#remisetotalButton').click(function() 
				{
					promptRemiseTotal(
						'<?php echo dol_buildpath($url, 1); ?>'
						,'<?php echo dol_buildpath('/remisetotal/script/interface.php', 2); ?>'
					     
					);
					
					return false;
				});
				$('a#modifqtyalimentaire').click(function() 
				{
					promptqtyalim(
						'<?php echo dol_buildpath($url, 1); ?>'
						,'<?php echo dol_buildpath('/remisetotal/script/interface_qtyalim.php', 2); ?>'
					     
					);
					
					return false;
				});
				
			});
	 	</script>
		<?php
		
	}
	
}
