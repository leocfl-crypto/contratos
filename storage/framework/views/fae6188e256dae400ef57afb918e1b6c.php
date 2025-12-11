<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicação Interna - <?php echo e($communication->code); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 20mm 25mm;
            background: #ffffff;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #2c3e50;
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        /* ========================================
           HEADER - Cabeçalho Minimalista
        ======================================== */
        .header-wrapper {
            border-bottom: 4px solid #0047AB;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header-container {
            display: table;
            width: 100%;
        }

        .header-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            padding-right: 15px;
        }

        .header-logo img {
            width: 65px;
            height: auto;
        }

        .header-text {
            display: table-cell;
            vertical-align: middle;
        }

        .header-title {
            font-size: 14pt;
            font-weight: 700;
            color: #0047AB;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .header-subtitle {
            font-size: 9pt;
            color: #657990;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
        }

        /* ========================================
           DOCUMENT TITLE - Título Principal
        ======================================== */
        .doc-title {
            text-align: center;
            margin: 35px 0 30px 0;
            padding: 18px 0;
            background: linear-gradient(135deg, #0047AB 0%, #0066CC 100%);
            border-radius: 6px;
        }

        .doc-title-text {
            font-size: 18pt;
            font-weight: 800;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 4px;
        }

        /* ========================================
           METADATA - Número e Data
        ======================================== */
        .metadata-container {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .metadata-left {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
        }

        .metadata-right {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
            text-align: right;
        }

        .doc-number {
            font-size: 13pt;
            font-weight: 800;
            color: #0047AB;
            letter-spacing: 0.5px;
        }

        .doc-date {
            font-size: 10pt;
            color: #657990;
            font-style: italic;
        }

        /* ========================================
           INFO GRID - Para/De Compacto
        ======================================== */
        .info-grid {
            display: table;
            width: 100%;
            margin: 25px 0;
            border: 2px solid #e8ecf1;
            border-radius: 8px;
            overflow: hidden;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 70px;
            padding: 12px 15px;
            background: #f8f9fb;
            border-right: 2px solid #e8ecf1;
            border-bottom: 1px solid #e8ecf1;
            font-weight: 700;
            font-size: 9.5pt;
            color: #0047AB;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }

        .info-row:last-child .info-label,
        .info-row:last-child .info-value {
            border-bottom: none;
        }

        .info-value {
            display: table-cell;
            padding: 12px 15px;
            border-bottom: 1px solid #e8ecf1;
            vertical-align: middle;
        }

        .info-name {
            font-size: 11pt;
            font-weight: 700;
            color: #2c3e50;
            display: block;
            margin-bottom: 3px;
        }

        .info-role {
            font-size: 9.5pt;
            color: #8896a8;
            font-style: italic;
        }

        /* ========================================
           SUBJECT - Assunto Destacado
        ======================================== */
        .subject-box {
            background: #f0f7ff;
            border-left: 5px solid #0047AB;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 0 6px 6px 0;
        }

        .subject-label {
            font-size: 9pt;
            font-weight: 700;
            color: #0047AB;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .subject-text {
            font-size: 11.5pt;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.5;
        }

        /* ========================================
           CONTENT - Conteúdo
        ======================================== */
        .content-area {
            margin: 30px 0;
            line-height: 1.8;
        }

        .content-greeting {
            margin-bottom: 20px;
            font-size: 11pt;
            color: #2c3e50;
        }

        .content-body {
            text-align: justify;
            color: #404e5c;
            line-height: 1.85;
        }

        .content-body p {
            margin-bottom: 15px;
            text-indent: 40px;
        }

        /* ========================================
           SIGNATURE - Assinatura
        ======================================== */
        .signature-area {
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .signature-closing {
            margin-bottom: 50px;
            color: #2c3e50;
        }

        .signature-block {
            text-align: center;
            margin-top: 60px;
        }

        .signature-line {
            width: 280px;
            border-top: 2px solid #2c3e50;
            margin: 0 auto 10px auto;
        }

        .signature-name {
            font-size: 11pt;
            font-weight: 700;
            text-transform: uppercase;
            color: #0047AB;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .signature-role {
            font-size: 9.5pt;
            color: #657990;
            font-style: italic;
        }

        /* ========================================
           FOOTER
        ======================================== */
        .footer {
            position: fixed;
            bottom: 15mm;
            left: 0;
            right: 0;
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #e8ecf1;
        }

        .footer-text {
            font-size: 8pt;
            color: #8896a8;
            line-height: 1.4;
        }

        .footer-watermark {
            font-size: 7.5pt;
            color: #b0bac7;
            margin-top: 3px;
            font-style: italic;
        }

        /* ========================================
           UTILITIES
        ======================================== */
        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-container">
            <div class="header-logo">
                <?php if(file_exists(public_path('images/brasao-lagoa-santa.png'))): ?>
                    <img src="<?php echo e(public_path('images/brasao-lagoa-santa.png')); ?>" alt="Brasão">
                <?php endif; ?>
            </div>
            <div class="header-text">
                <div class="header-title">Prefeitura Municipal de Lagoa Santa</div>
                <div class="header-subtitle">Estado de Minas Gerais</div>
            </div>
        </div>
    </div>

    <!-- DOCUMENT TITLE -->
    <div class="doc-title">
        <div class="doc-title-text">Comunicação Interna</div>
    </div>

    <!-- METADATA -->
    <div class="metadata-container">
        <div class="metadata-left">
            <div class="doc-number">Nº <?php echo e($communication->code); ?><?php if($communication->department): ?> / <?php echo e($communication->department); ?><?php endif; ?></div>
        </div>
        <div class="metadata-right">
            <div class="doc-date">Lagoa Santa/MG, <?php echo e($communication->formatted_date); ?></div>
        </div>
    </div>

    <!-- INFO GRID -->
    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">PARA:</div>
            <div class="info-value">
                <span class="info-name"><?php echo e($communication->recipient_name); ?></span>
                <?php if($communication->recipient_role): ?>
                    <span class="info-role"><?php echo e($communication->recipient_role); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">DE:</div>
            <div class="info-value">
                <span class="info-name"><?php echo e($communication->sender_name); ?></span>
                <?php if($communication->sender_role): ?>
                    <span class="info-role"><?php echo e($communication->sender_role); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- SUBJECT -->
    <div class="subject-box">
        <div class="subject-label">Assunto:</div>
        <div class="subject-text"><?php echo e($communication->subject); ?></div>
    </div>

    <!-- CONTENT -->
    <div class="content-area">
        <div class="content-greeting">Prezado(a) Senhor(a),</div>
        <div class="content-body">
            <?php echo $communication->formatted_content; ?>

        </div>
    </div>

    <!-- SIGNATURE -->
    <div class="signature-area no-break">
        <div class="signature-closing">Atenciosamente,</div>
        <div class="signature-block">
            <div class="signature-line"></div>
            <div class="signature-name"><?php echo e(strtoupper($communication->sender_name)); ?></div>
            <?php if($communication->sender_role): ?>
                <div class="signature-role"><?php echo e($communication->sender_role); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-text">Prefeitura Municipal de Lagoa Santa - Estado de Minas Gerais</div>
        <div class="footer-watermark">Documento gerado eletronicamente</div>
    </div>

</body>

</html><?php /**PATH C:\Projects\contratos\resources\views/pdf/internal-communication.blade.php ENDPATH**/ ?>