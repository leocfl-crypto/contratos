<script setup lang="ts">
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { Form } from '@inertiajs/vue3';
import { useTemplateRef } from 'vue';

// Components
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const passwordInput = useTemplateRef('passwordInput');
</script>

<template>
    <div class="space-y-6">
        <HeadingSmall
            title="Deletar conta"
            description="Deletar sua conta e todos os seus recursos"
        />
        <div
            class="space-y-4 rounded-lg border-2 border-red-200 bg-red-50 p-6"
        >
            <div class="relative space-y-1 text-red-700">
                <p class="text-sm font-medium">
                    A exclusão da conta é permanente e não pode ser desfeita. Todos os seus dados serão perdidos.
                </p>
            </div>
            <Dialog>
                <DialogTrigger as-child>
                    <Button 
                        variant="destructive" 
                        size="lg"
                        class="w-full sm:w-auto font-semibold shadow-md hover:shadow-lg transition-all duration-200 bg-red-900 hover:bg-red-950 text-white"
                        data-test="delete-user-button"
                        >Deletar Conta Permanentemente</Button
                    >
                </DialogTrigger>
                <DialogContent>
                    <Form
                        v-bind="ProfileController.destroy.form()"
                        reset-on-success
                        @error="() => passwordInput?.$el?.focus()"
                        :options="{
                            preserveScroll: true,
                        }"
                        class="space-y-6"
                        v-slot="{ errors, processing, reset, clearErrors }"
                    >
                        <DialogHeader class="space-y-3">
                            <DialogTitle
                                >Tem certeza de que deseja deletar sua
                                conta?</DialogTitle
                            >
                            <DialogDescription>
                                Depois que sua conta for deletada, todos os seus
                                recursos e dados também serão permanentemente
                                excluídos. Por favor, digite sua senha para confirmar
                                que deseja deletar permanentemente sua
                                conta.
                            </DialogDescription>
                        </DialogHeader>

                        <div class="grid gap-2">
                            <Label for="password" class="sr-only"
                                >Senha</Label
                            >
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                ref="passwordInput"
                                placeholder="Senha"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <DialogFooter class="gap-2">
                            <DialogClose as-child>
                                <Button
                                    variant="secondary"
                                    @click="
                                        () => {
                                            clearErrors();
                                            reset();
                                        }
                                    "
                                >
                                    Cancelar
                                </Button>
                            </DialogClose>

                            <Button
                                type="submit"
                                variant="destructive"
                                :disabled="processing"
                                data-test="confirm-delete-user-button"
                            >
                                Deletar conta
                            </Button>
                        </DialogFooter>
                    </Form>
                </DialogContent>
            </Dialog>
        </div>
    </div>
</template>
