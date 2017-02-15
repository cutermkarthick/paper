<div class="main-container">
		<div class="container-fluid">
			<section>
    <div id="profile" class="tab-pane fade">
        <div class="row-fluid patient_history">
        <h1>Book an Appointment </h1>
        <div class="clearfix">  </div>
        <div class="span11 m-widget">
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'style' => 'padding-top:20px;');
                echo form_open('doctor_ctrl/temp', $attributes);
            ?>
            <div class="control-group">
                <?php
                    $attributes = array('class' => 'control-label');
                    echo form_label('Dentist:', 'inputEmail', $attributes);
                ?>                                                    

                <div class="controls">
                    <?php $options = array(
                    'Stephanie'  => 'Dr Stephanie Marshall',
                    'Walsh'    => 'Dr Joe Walsh',
                    'Jessica'   => 'Dr Jessica White');
                    $attributes = 'id="select01" class="input-xlarge"';                 
                    echo form_dropdown('dct_name', $options,'small',$attributes);
                    ?>
                </div> 
            </div>
    <div class="control-group">
        <?php
            $attributes = array('class' => 'control-label');
            echo form_label('Date of Appointment:', 'inputPassword', $attributes);
        ?>  
        <div class="controls">
            <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                <?php
                    $data = array(
                    'class'       => 'input-xlarge',
                    'type'	  =>"text",
                     'name'       => "app_date",
                    'value'       => '12-02-2012',              
                    'size'        => '16',              
                    );
                    echo form_input($data);
                ?>
                 <span style="position:relative; left:-30px; z-index:1;" class="add-on">
                     <i class="icon-th"></i>
                 </span>
            </div>
        </div>
    </div>
            
    <div class="control-group">
        <?php
            $attributes = array('class' => 'control-label');
            echo form_label('Location:', 'inputPassword', $attributes);
        ?><?php echo form_error('location'); ?>
        <div class="controls">
            <?php
                $data = array(
		      'class'        => 'input-xlarge',
		      'type'	     =>"text",
                       'id'         =>"loc",
                      'name'	     =>"location",
      		      'placeholder'  => 'Location',	                    
                    );
		echo form_input($data);
            ?>	
        </div>
    </div>
            
    <div class="control-group">
        <?php
            $attributes = array('class' => 'control-label');
            echo form_label('Time:', 'inputPassword', $attributes);
        ?>  
        <div class="controls">
            <?php
                $data = array(
                             'class'        => 'input-xlarge',
                             'type'	    =>"text",
                             'name'	    =>"app_time",
                             'value' => "12:45:34",
//                             'placeholder'  => '00:pm/am',	                    
                             );
                echo form_input($data);
            ?>	
        </div>

    </div>

    
    <div class="control-group">
        <?php
            $attributes = array(
                        'class' => 'control-label'                                                                   
                    );
            echo form_label('Purpose:', 'inputPassword', $attributes);
        ?>                                                    

        <div class="controls">
                    <?php $options = array(
                    'small'  => 'Consultation',
                    'med'    => 'Preventive',
                    'large'   => 'Deep Cleaning',
		    'medsm'  => 'Filling',
                    'medlg'    => 'Root Canal',
		    'medsm'  => 'Extraction',
                    'largelg'    => 'Implant',
                    'name'       => 'reason',
		    'xlarge'    => 'Other',		     
		     );
                    $attributes = 'id="select01" class="input-xlarge"';                 
                    echo form_dropdown('purpose', $options,'small',$attributes);
                    ?>
	</div> 
    </div>
    <div class="control-group">
        <?php
            $attributes = array('class' => 'control-label');
            echo form_label('Remarks:', 'inputPassword', $attributes);
        ?>
        <div class="controls">
            <?php
                $data = array(
		      'class'        => 'input-xlarge',
		      'type'	     =>"text",
      		      'placeholder'  => 'Remarks',
                      'name'         =>'remarks'
                    );
		echo form_input($data);
            ?>	
        </div>
    </div>
     <div class="control-group">
	<?php
	    $attributes = array('class' => 'control-label');
	    echo form_label('Reminders:', 'inputPassword', $attributes);
	?>
	<div class="controls">
            <label class="checkbox inline">
		<?php
                    $data = array(
                            'class'        => 'input-xlarge',
                            'type'	     =>"radio",
                            'name'        => 'sms_email',
                            'id'	     =>"optionsRadios1",
                            'value'  => 'option1',
                            'checked'     => TRUE,
                            );
                    echo form_input($data);
                ?>
                SMS and Email
            </label>
            <label class="checkbox inline">
		<?php
                    $data = array(
                            'class'        => 'input-xlarge',
                            'type'	     =>"radio",
                            'name'        => 'email',
                            'id'	     =>"optionsRadios2",
                            'value'  => 'option2',
                            );
                    echo form_radio($data);
                ?>
                Email
            </label>
	</div>
    </div>
    <div style="margin-top:25px;" class="control-group">
        <div class="controls">
            <?php            
//                $data = array(
//                            'class' => 'btn btn-large btn-success',
//                            'type' => 'button',                            
//                            );
//                $content= '<i class="fa fa-check"></i>Book Appointment';
//                echo form_button($data, $content)                        
//            ?>
            <?php echo form_submit(array('id' => 'submit', 'value' => 'Book Appointment'));?>
        </div>             
    </div>      
    <?php echo form_close(); ?>            
    </div>
    </div>
    </div>
                        </section>
                </div>
</div>