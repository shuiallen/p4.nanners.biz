$('#create-time-entry').click(function() {
 console.log('in create time entry');
    var options = {
        type: 'POST',
        url: '/time_entry/p_create',
        success: function(response) { 
            console.log("in success case");
            console.log(response);
            var data = $.parseJSON(response);
            // How to determine success of create?  ajax call was successful
            // what to display now?
            var status;
            if (data['time_entry_id'] == -1) {
                status = ' does not exist';
                $('#time_entry_id').html("failed");       
            } else {
                $('#time_entry_id').html(data['time_entry_id']);
                status = ' succeeded';
            }
            console.log(status);
            $('#te_task_id').html(data['task_id']);
            $('#te_status').html(status);

            $('#new-time-entry-status').show();
        },
        resetForm: true
    }
    $('#new-time-entry').ajaxForm(options);
    // display it now
});

$('find-te-for-task').click(function() {


});

(function($){
    $.extend({
        APP : {

            formatTimer : function(a) {
                if (a < 10) {
                    a = '0' + a;
                }                              
                return a;
            },    
                
            startTimer : function(dir) {              
                var a;               
                // save type
                $.APP.dir = dir;
                
                // get current date
                $.APP.d1 = new Date();
                
                switch($.APP.state) {
                case 'pause' :
                    // resume timer
                    // get current timestamp (for calculations) and
                    // substract time difference between pause and now
                    $.APP.t1 = $.APP.d1.getTime() - $.APP.td;                            
                    break;
                        
                default :
                    // get current timestamp (for calculations)
                    $.APP.t1 = $.APP.d1.getTime(); 
                    break;   
                }                                   
                
                // reset state
                $.APP.state = 'alive';   
                $('#' + $.APP.dir + '_status').html('Running');
                
                // start loop
                $.APP.loopTimer();
                
            },
            
            pauseTimer : function() {
                // save timestamp of pause
                $.APP.dp = new Date();
                $.APP.tp = $.APP.dp.getTime();
                
                // save elapsed time (until pause)
                $.APP.td = $.APP.tp - $.APP.t1;
                
                // change button value
                $('#' + $.APP.dir + '_start').val('Resume');
                
                // set state
                $.APP.state = 'pause';
                $('#' + $.APP.dir + '_status').html('Paused');
            },
            
            stopTimer : function() {

                // change button value
                $('#' + $.APP.dir + '_start').val('Restart');                    
                
                // set state
                $.APP.state = 'stop';
                $('#' + $.APP.dir + '_status').html('Stopped');
            },
            
            resetTimer : function() {
                console.log('reset timer');
                // reset display
                $('#' + $.APP.dir + '_ms,#' + $.APP.dir + '_s,#' + $.APP.dir + '_m,#' + $.APP.dir + '_h').html('00');                 
                
                // change button value
                $('#' + $.APP.dir + '_start').val('Start');                    
                
                // set state
                $.APP.state = 'reset';  
                $('#' + $.APP.dir + '_status').html('Reset & Idle again');
            },
            
            endTimer : function(callback) {
                // change button value
                $('#' + $.APP.dir + '_start').val('Restart');
                
                // set state
                $.APP.state = 'end';
                
                // invoke callback
                if (typeof callback === 'function') {
                    callback();
                }
            },    
                
            loopTimer : function() {
                var td;
                var d2,t2;
                
                var ms = 0;
                var s  = 0;
                var m  = 0;
                var h  = 0;
                
                if ($.APP.state === 'alive') {
                    // get current date and convert it into 
                    // timestamp for calculations
                    d2 = new Date();
                    t2 = d2.getTime();   
                    
                    // calculate time difference between initial and current timestamp
                    td = t2 - $.APP.t1;
                    
                    // calculate milliseconds
                    ms = td%1000;
                    if (ms < 1) {
                        ms = 0;
                    } else {    
                        // calculate seconds
                        s = (td-ms)/1000;
                        if (s < 1) {
                            s = 0;
                        } else {
                            // calculate minutes   
                            var m = (s-(s%60))/60;
                            if (m < 1) {
                                m = 0;
                            } else {
                                // calculate hours
                                var h = (m-(m%60))/60;
                                if (h < 1) {
                                    h = 0;
                                }                             
                            }    
                        }
                    }
                  
                    // substract elapsed minutes & hours
                    ms = Math.round(ms/100);
                    s  = s-(m*60);
                    m  = m-(h*60);                                
                    
                    // update display
                    $('#' + $.APP.dir + '_ms').html($.APP.formatTimer(ms));
                    $('#' + $.APP.dir + '_s').html($.APP.formatTimer(s));
                    $('#' + $.APP.dir + '_m').html($.APP.formatTimer(m));
                    $('#' + $.APP.dir + '_h').html($.APP.formatTimer(h));

                    // update global total counter
                    $.APP.hours = h;
                    $.APP.mins = m;
                    //console.log('looping');
                    
                    // loop
                    $.APP.t = setTimeout($.APP.loopTimer,10);
                } else {
                    // kill loop
                    clearTimeout($.APP.t);
                    return true;
                }  
            },

            recordTime : function () {
                console.log('record time');
                $.APP.stopTimer();
                console.log('try to call ajax');
                $.ajax({
                    type: 'POST',
                    url: '/time_entry/p_create',
                    success: function(response) { 
                        var data = $.parseJSON(response);
                        var status;
                        if (data['time_entry_id'] == 0) {
                            status = ' missing';
                            $('#tte_id').html("failed");
                        } else if (data['time_entry_id'] == -1) {
                            status = ' does not exist';
                            $('#tte_id').html("failed");       
                        } else {
                            $('#tte_id').html(data['time_entry_id']);
                            status = ' succeeded';
                            $.APP.resetTimer();
                        }
                        console.log(status);
                        $('#tte_task_id').html(data['task_id']);
                        $('#tte_status').html(status);

                        $('#timer-entry-status').show();
                    },
                    data: {
                        task_id : $('#timer_task_id').val(),
                        hours   : $.APP.hours,
                        mins    : $.APP.mins,
                        date    : new Date(),
                        token   : $('#timer-token').val()
                    }
                });
            }
                    
        }    
    
    });
      
    $('#sw_start').on('click', function() {
        $.APP.startTimer('sw');
    });       
    
    $('#sw_stop').on('click', function() {
        $.APP.stopTimer();
    });
    
    $('#sw_reset').on('click', function() {
        $.APP.resetTimer();
    });  
    
    $('#sw_pause').on('click', function() {
        $.APP.pauseTimer();
    });

    $('#record').on('click', function() {
        $.APP.recordTime();
    });                       
})(jQuery);
        