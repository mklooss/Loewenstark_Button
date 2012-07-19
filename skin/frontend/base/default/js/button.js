function ButtonToggleAgreement( id ) {
    container = "agreement-content-"+id;
    if( $(container).hasClassName("open") ) {
        $(container).removeClassName("open");
    } else {
        $(container).addClassName("open");
    }
    return false;
}