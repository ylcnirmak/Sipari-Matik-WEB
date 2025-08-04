<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <title>{{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            color: #1e293b;
            position: relative;
            overflow-x: hidden;
            background-color: #1e293b;
        }

        .main-content {
            padding: 10px;
            position: relative;
            z-index: 1;
        }

        /* Enhanced Category Tabs */
        .category-tabs {
            display: flex;
            gap: 10px;
            margin: 20px 0 20px 0;
            align-items: center;
        }

        .right-buttons {
            margin-left: auto;
            display: flex;
            gap: 10px;
        }

        .logout-button {
            background-color: #dc3545;
        }

        .settings-button {
            background-color: #6c757d;
        }


        /* Model */
.modal {
    display: none !important;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
}

.modal.show {
    display: block !important;
}

.modal-content {
    background-color: #fff;
    margin: 2% auto;
    padding: 0;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.7); }
    to { opacity: 1; transform: scale(1); }
}

.large-modal {
    width: 90%;
    max-width: 1200px;
    height: 85vh;
    max-height: 800px;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px 30px;
    border-radius: 15px 15px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
}

.close {
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    color: rgba(255,255,255,0.8);
    transition: color 0.3s ease;
}

.close:hover {
    color: white;
}

.modal-body {
    padding: 30px;
    height: calc(100% - 140px);
    overflow-y: auto;
    background-color: #f8f9fa;
}

.settings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
    height: 100%;
}

.settings-column h3 {
    color: #333;
    margin-bottom: 20px;
    padding: 15px 0;
    border-bottom: 3px solid #667eea;
    font-size: 20px;
    font-weight: 600;
    text-align: center;
    background: white;
    border-radius: 10px 10px 0 0;
}

.setting-btn {
    width: 100%;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    text-align: left;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.setting-btn:hover {
    border-color: #667eea;
    background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(102,126,234,0.3);
}

.setting-btn.danger {
    border-color: #dc3545;
}

.setting-btn.danger:hover {
    border-color: #dc3545;
    background: linear-gradient(135deg, #fff5f5 0%, #ffebee 100%);
    box-shadow: 0 6px 20px rgba(220,53,69,0.3);
}

.setting-btn i {
    font-size: 28px;
    margin-right: 20px;
    color: #667eea;
    min-width: 35px;
    text-align: center;
}

.setting-btn.danger i {
    color: #dc3545;
}

.setting-btn div {
    flex: 1;
}

.setting-btn strong {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

.setting-btn small {
    color: #6c757d;
    font-size: 13px;
    line-height: 1.4;
}

.modal-footer {
    background: white;
    padding: 20px 30px;
    border-top: 1px solid #dee2e6;
    border-radius: 0 0 15px 15px;
    text-align: right;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 992px) {
    .settings-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .settings-grid {
        grid-template-columns: 1fr;
    }
    
    .large-modal {
        width: 95%;
        height: 90vh;
    }
    
    .modal-body {
        padding: 20px;
    }
}


        /* Model */

        

        .category-tabs form {
            margin-left: auto;
        }

        

        .category-tab {
            padding: 20px 32px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            color: #64748b;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .category-tab:hover {
            transform: translateY(-2px);
            border-color: #cbd5e1;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .category-tab.active {
            background: #e63d3d;
            color: white;
            border-color: black;
            border-width: 1px;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }



        .back-button {
            margin-left: auto;
            background: #ef4444 !important;
            border-color: #ef4444 !important;
            color: white !important;
        }

        .back-button:hover {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
        }

        /* Modern Tables Grid */
        .tables-container {
            border-radius: 20px;
        }

        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }

        .table-card {
            aspect-ratio: 1;
            background: white;
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: none;
        }

        .table-card.available {
            background: #f1f5f9;
            color: #64748b;
        }

        .table-card.occupied {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
        }

        .table-card.reserved {
            background: linear-gradient(135deg, #f59e0b, #c2410c);
        }

        .table-card.locked {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            opacity: 0.9;
            pointer-events: none;
        }

        .table-card.locked .table-content {
            filter: blur(2px);
        }

        .table-card.locked .table-number {
            filter: blur(0px) !important;
            opacity: 0.7;
            color: white !important;
        }

        .table-card.locked .table-price,
        .table-card.locked .table-footer {
            opacity: 0;
        }

        .table-card.locked::after {
            content: '';
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            content: '\f023';
            font-size: 32px;
            color: white;
            z-index: 10;
            filter: none;
        }

        .table-card.locked::before {
            content: 'İşlem Yapılıyor...';
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            z-index: 10;
            filter: none;
        }

        .table-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .table-header {
            position: absolute;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
        }

        .table-number {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
            line-height: 1;
        }

        .table-card.available .table-number {
            color: #334155;
        }

        .table-card.occupied .table-number,
        .table-card.reserved .table-number {
            color: white;
        }

        .table-status {
            width: 40px;
            height: 8px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.4);
        }

        .table-card.available .table-status {
            background: rgba(100, 116, 139, 0.3);
        }

        .table-price {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 16px;
            line-height: 1;
        }

        .table-card.available .table-price {
            color: #64748b;
        }

        .table-card.occupied .table-price,
        .table-card.reserved .table-price {
            color: white;
        }

        .table-footer {
            position: absolute;
            bottom: 16px;
            left: 16px;
            right: 16px;
            display: flex;
            justify-content: space-between;
            align-items: end;
        }

        .table-time {
            font-size: 11px;
            font-weight: 600;
            line-height: 1;
        }

        .table-waiter {
            font-size: 11px;
            font-weight: 600;
            line-height: 1;
            text-align: right;
        }

        .table-card.available .table-time,
        .table-card.available .table-waiter {
            color: rgba(100, 116, 139, 0.8);
        }

        .table-card.occupied .table-time,
        .table-card.occupied .table-waiter,
        .table-card.locked .table-time,
        .table-card.locked .table-waiter,
        .table-card.locked .table-number,
        .table-card.locked .table-price {
            color: rgba(255, 255, 255, 0.9);
        }

        .table-card.locked .table-status {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Icon styles */
        .table-icon {
            position: absolute;
            top: 50%;
            right: 16px;
            transform: translateY(-50%);
            font-size: 16px;
            opacity: 0.8;
            color: rgba(255, 255, 255, 0.9);
        }

        .reserved-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .reserved-time {
            font-size: 18px;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .reserved-name {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }



        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                padding: 24px;
            }

            .tables-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 12px;
            }

            .table-card {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .tables-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 10px;
            }

            .table-card {
                padding: 12px;
            }

            .table-number {
                font-size: 12px;
            }

            .table-price {
                font-size: 14px;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 2s infinite;
        }

        
    </style>
    @livewireStyles
</head>
<body>
    
        @yield('content')
    @livewireScripts
</body>
</html>