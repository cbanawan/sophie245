<?php Yii::app()->getClientScript()->registerScript("submit-search", "
		$('#order-search-form').submit(function(){
			$('#orders-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		
		$('.form-control').click(function(){
			$(this).val('');
			// return false;
		});
	");	

	$form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
            array(
                'id' => 'order-search-form',
                'method' => 'get',
                'action'=>Yii::app()->createUrl($this->route),
            )
	); ?>

    <div class="container-fluid">
            <div class="row">
                    <div class="col-sm-2">
                    <?php
                        echo $form->textFieldGroup(
                            $model,
                            'id',
                            array(
                                'class' => 'col-sm-2',
                                'prepend' => '<i class="glyphicon glyphicon-search"></i>',
                            )
                        );
                    ?>
                    </div>
                    <div class="col-sm-4">
                    <?php
                        echo $form->textFieldGroup(
                            $model,
                            'memberName',
                            array(
                                'label' => 'Search Lastname',
                                'class' => 'col-sm-4',
                                'prepend' => '<i class="glyphicon glyphicon-user"></i>',
                            )
                        );
                    ?>
                    </div>
            </div>
            <div class="row">
                    <?php 
                        echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); 
                    ?>
            </div>
    </div>

    <div class="search-form" style="display:none">		
            <div class="container-fluid well">
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-5">
                         <?php
                             echo $form->textFieldGroup(
                                 $model,
                                 'memberCode',
                                 array(
                                     'wrapperHtmlOptions' => array(
                                         'class' => 'col-sm-5',
                                     ),
                                 )
                             );
                         ?>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                        <?php
                            echo $form->dateRangeGroup(
                                $model,
                                'dateCreatedRange',
                                array(
                                    'widgetOptions' => array(
                                        'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
                                    ), 
                                    'wrapperHtmlOptions' => array(
                                        'class' => 'col-sm-5',
                                    ),
                                    'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
                                )
                            );								

                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                <?php
                    echo $form->checkboxListGroup(
                        $model,
                        'orderStatusId',
                        array(
                            'widgetOptions' => array(
                                    'data' => $orderStatus,
                            ),
                            // 'hint' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.'
                        )
                    );						
                ?>
                </div>

            </div>
    </div>

    <div class="buttons">
    <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'label' => 'Search',
                'context' => 'primary',
            )
        );

        echo ' ';

        $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'reset',
                'label' => 'Clear',
                'context' => 'default',
            )
        );
    ?>
    </div>
			
<?php $this->endWidget(); ?>

