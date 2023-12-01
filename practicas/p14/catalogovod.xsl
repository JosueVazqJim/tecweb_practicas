<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>Mi primera transformación</title>
                <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css"/>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>   
                <style type="text/css">
                    
                    .principal{
                    background-color: #f3f3f3;
                    border: none;
                    display: block;
                    margin: 0px 0;
                    padding: 0;
                    text-align: center;
                    width: 100%;
                    }
                    nav h1{
                    font-family: "Roboto",sans-serif;
                    font-weight: 700;
                    color: #000;
                    }
                    
                    .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link.active {
                    color: var(--secondary);
                    }
                    .activeNav{
                    border-bottom: 5px solid gray;
                    }
                    
                    .lt{
                    margin: 0 20px 0 0;
                    }
                    .navbar-light .navbar-nav .nav-link {
                    font-family: 'Roboto', sans-serif;
                    margin-left: 30px;
                    padding: 30px 0;
                    font-size: 16px;
                    font-weight: 700;
                    text-transform: uppercase;
                    }
                    
                    .btn{
                    font-family: 'Roboto', sans-serif!important;
                    font-weight: 700!important;
                    transition: 1s!important;
                    border-radius: 0!important;
                    }
                    
                    .imagen{
                        width: 10vw;
                        height: 10vw
                    }
                    
                </style>
            </head>
            <body>
                <div>
                    <div class="principal">
                        <!--Inicia NAV -->
                        <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
                            <a href="#" class="navbar-brand ms-lg-5">
                              <img class="img-fluid imagen" src="logoC.png"></img>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <div class="navbar-nav ms-auto py-0">
                                    <a href="#" class="nav-item nav-link active activeNav">Catálogo</a>
                                    <a href="#" class="nav-item nav-link">Películas</a>
                                    <a href="#" class="nav-item nav-link ">Series</a>
                                    <a href="#" class="nav-item nav-link lt">Planes</a>
                                    <a href="#" class="nav-link bg-back text-white px-5 ms-lg-4 btn btn-dark active activeNav">
                                        <i class="bi bi-people"></i>
                                        Perfiles
                                    </a>
                                </div>
                            </div>
                        </nav>
                        <!--FIN NAV -->
                        
                        <div class="container-fluid">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 px-0 m-3">
                                        <div class="border-start border-end border-5 border-dark col-12 px-3 py-3 mb-5">
                                                <h1 class="display-5 text-uppercase">Catálogo completo</h1>
                                        </div>
                                        
                                        <!-- inicio del tab -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#movies" aria-selected="true" role="tab">Películas</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#series" aria-selected="false" role="tab" tabindex="-1">Series</a>
                                            </li>
                                            
                                        </ul>
                                        <div id="myTabContent" class="tab-content" bis_skin_checked="1">
                                            <div class="tab-pane fade active show" id="movies" role="tabpanel" bis_skin_checked="1">
                                                <!--Inicio peliculas-->
                                                <div>
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th scope="col">Título</th>
                                                                <th scope="col">Duración</th>
                                                                <th scope="col">Género</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <xsl:for-each select="//peliculas/genero/titulo">
                                                                <tr>
                                                                    <th><xsl:value-of select="."/></th>
                                                                    <td><xsl:value-of select="./@duracion"/></td>
                                                                    <td><xsl:value-of select="../@nombre"/></td>
                                                                </tr>
                                                            </xsl:for-each>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--fin peliculas-->
                                            </div>
                                            <div class="tab-pane fade" id="series" role="tabpanel" bis_skin_checked="1">
                                                <!--Inicio series-->
                                                <div>
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-dark">
                                                                <th scope="col">Título</th>
                                                                <th scope="col">Duración</th>
                                                                <th scope="col">Género</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <xsl:for-each select="//series/genero/titulo">
                                                                <tr>
                                                                    <th><xsl:value-of select="."/></th>
                                                                    <td><xsl:value-of select="./@duracion"/></td>
                                                                    <td><xsl:value-of select="../@nombre"/></td>
                                                                </tr>
                                                            </xsl:for-each>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--fin series-->
                                            </div>
                                        </div>
                                        <!-- Fin del tab -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>