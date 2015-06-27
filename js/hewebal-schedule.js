$(function() {

	// Get Date and break into needed parts
    d = new Date();
    h = (d.getHours()<10?'0':'') + d.getHours();
    m = (d.getMinutes()<10?'0':'') + d.getMinutes();
    year = d.getFullYear();
    month = (d.getMonth()<10?'0':'') + d.getMonth();
    day =  (d.getDate()<10?'0':'') + d.getDate();
    todayNumeric = Number(year + month + day);
    // Schedule days, remember month starts at zero
    scheduleDay1 = 20150529;
    scheduleDay2 = 20150530;
    currentTime = Number(h + m);

    if (todayNumeric = scheduleDay1){

        if (currentTime < 0700) {
            scrollToLocation = "#day_1";
        } else if (currentTime < 0830) {
            scrollToLocation = "#day_1_schedule_1";
        } else if (currentTime < 0845) {
            scrollToLocation = "#day_1_schedule_2";
        } else if (currentTime < 0900) {
            scrollToLocation = "#day_1_schedule_3";
        } else if (currentTime < 0945) {
            scrollToLocation = "#day_1_schedule_4";
        } else if (currentTime < 1000) {
            scrollToLocation = "#day_1_schedule_5";
        } else if (currentTime < 1045) {
            scrollToLocation = "#day_1_schedule_6";
        } else if (currentTime < 1100) {
            scrollToLocation = "#day_1_schedule_7";
        } else if (currentTime < 1200) {
            scrollToLocation = "#day_1_schedule_8";
        } else if (currentTime < 1400) {
            scrollToLocation = "#day_1_schedule_9";
        } else if (currentTime < 1445) {
            scrollToLocation = "#day_1_schedule_10";
        } else if (currentTime < 1500) {
            scrollToLocation = "#day_1_schedule_11";
        } else if (currentTime < 1545) {
            scrollToLocation = "#day_1_schedule_12";
        } else if (currentTime < 1615) {
            scrollToLocation = "#day_1_schedule_13";
        } else if (currentTime < 1700) {
            scrollToLocation = "#day_1_schedule_14";
        } else if (currentTime < 1900) {
            scrollToLocation = "#day_1_schedule_15";
        } else if (currentTime < 2200) {
            scrollToLocation = "#day_1_schedule_16";
        } else {
            scrollToLocation = "#pageTop";
        }

    } else if (todayNumeric = scheduleDay2){

        if (currentTime < 0700) {
            scrollToLocation = "#day_2";
        } else if (currentTime < 0830) {
            scrollToLocation = "#day_2_schedule_1";
        } else if (currentTime < 0915) {
            scrollToLocation = "#day_2_schedule_2";
        } else if (currentTime < 0930) {
            scrollToLocation = "#day_2_schedule_3";
        } else if (currentTime < 1015) {
            scrollToLocation = "#day_2_schedule_4";
        } else if (currentTime < 1030) {
            scrollToLocation = "#day_2_schedule_5";
        } else if (currentTime < 1115) {
            scrollToLocation = "#day_2_schedule_6";
        } else if (currentTime < 1130) {
            scrollToLocation = "#day_2_schedule_7";
        } else if (currentTime < 1200) {
            scrollToLocation = "#day_2_schedule_8";
        } else {
            scrollToLocation = "#pageTop";
        }

    } else {
        scrollToLocation = "#pageTop";
    }

    $(document).scrollTop( $(scrollToLocation).offset().top );
});