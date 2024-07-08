function irA (param) {
    switch (param) {
        case "inicio":
            window.location.href = 'adminr.php';        
            break;
    
        case "asignados":
            window.location.href = 'asignados.php';        
            break;
        default:
            break;
    }
}