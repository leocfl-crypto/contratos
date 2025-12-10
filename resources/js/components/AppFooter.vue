<script setup lang="ts">
import { Icon } from '@iconify/vue';

const currentYear = new Date().getFullYear();
</script>

<template>
    <footer class="app-footer">
        <div class="footer-container">
            <!-- Logo e Descrição -->
            <div class="footer-section footer-brand">
                <div class="brand-content">
                    <div class="brand-logo">
                        <Icon icon="mdi:file-document-multiple" class="logo-icon" />
                        <h3 class="brand-title">Sistema de Contratos</h3>
                    </div>
                    <p class="brand-description">
                        Gerenciamento inteligente e eficiente de contratos para sua
                        organização.
                    </p>
                </div>
            </div>

            <!-- Links Rápidos -->
            <div class="footer-section">
                <h4 class="section-title">Links Rápidos</h4>
                <ul class="footer-links">
                    <li>
                        <a href="/dashboard" class="footer-link">
                            <Icon icon="mdi:view-dashboard" />
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/contratos" class="footer-link">
                            <Icon icon="mdi:file-document" />
                            Contratos
                        </a>
                    </li>
                    <li>
                        <a href="/relatorios" class="footer-link">
                            <Icon icon="mdi:chart-line" />
                            Relatórios
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Suporte -->
            <div class="footer-section">
                <h4 class="section-title">Suporte</h4>
                <ul class="footer-links">
                    <li>
                        <a href="#" class="footer-link">
                            <Icon icon="mdi:help-circle" />
                            Central de Ajuda
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <Icon icon="mdi:book-open" />
                            Documentação
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <Icon icon="mdi:email" />
                            Contato
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div class="footer-section">
                <h4 class="section-title">Siga-nos</h4>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <Icon icon="mdi:facebook" />
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <Icon icon="mdi:twitter" />
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <Icon icon="mdi:linkedin" />
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <Icon icon="mdi:instagram" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="bottom-container">
                <p class="copyright">
                    © {{ currentYear }} Sistema de Contratos. Todos os direitos
                    reservados.
                </p>
                <div class="bottom-links">
                    <a href="#" class="bottom-link">Privacidade</a>
                    <span class="separator">•</span>
                    <a href="#" class="bottom-link">Termos de Uso</a>
                    <span class="separator">•</span>
                    <a href="#" class="bottom-link">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.app-footer {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    color: #e2e8f0;
    margin-top: auto;
    position: relative;
    overflow: hidden;
}

.app-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(148, 163, 184, 0.3),
        transparent
    );
}

.footer-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2.5rem 2rem 1.5rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

/* Brand Section */
.footer-brand {
    grid-column: span 1;
}

@media (min-width: 1024px) {
    .footer-brand {
        grid-column: span 2;
    }
}

.brand-content {
    max-width: 350px;
}

.brand-logo {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    margin-bottom: 0.75rem;
}

.logo-icon {
    font-size: 1.5rem;
    color: #3b82f6;
    filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.4));
}

.brand-title {
    font-size: 1.125rem;
    font-weight: 700;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
}

.brand-description {
    color: #94a3b8;
    line-height: 1.5;
    font-size: 0.85rem;
    margin: 0;
}

/* Section Titles */
.section-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 0.875rem;
    position: relative;
    padding-bottom: 0.375rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 32px;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    border-radius: 2px;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-link {
    color: #94a3b8;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.825rem;
    transition: all 0.3s ease;
    padding: 0.125rem 0;
}

.footer-link:hover {
    color: #3b82f6;
    transform: translateX(4px);
}

.footer-link svg {
    font-size: 1rem;
    flex-shrink: 0;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 0.625rem;
    flex-wrap: wrap;
}

.social-link {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(148, 163, 184, 0.1);
    border: 1px solid rgba(148, 163, 184, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.4);
    color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.social-link svg {
    font-size: 1.125rem;
}

/* Footer Bottom */
.footer-bottom {
    border-top: 1px solid rgba(148, 163, 184, 0.1);
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(10px);
}

.bottom-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.copyright {
    color: #64748b;
    font-size: 0.8125rem;
    margin: 0;
}

.bottom-links {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    flex-wrap: wrap;
}

.bottom-link {
    color: #64748b;
    text-decoration: none;
    font-size: 0.8125rem;
    transition: color 0.3s ease;
}

.bottom-link:hover {
    color: #3b82f6;
}

.separator {
    color: #475569;
    user-select: none;
}

/* Responsive */
@media (max-width: 768px) {
    .footer-container {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 2rem 1.5rem 1rem;
    }

    .footer-brand {
        grid-column: span 1;
    }

    .bottom-container {
        flex-direction: column;
        text-align: center;
        padding: 1rem 1.5rem;
    }

    .bottom-links {
        justify-content: center;
    }
}

/* Animations */
@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-4px);
    }
}

.footer-link:hover svg {
    animation: float 1s ease-in-out infinite;
}
</style>
