<?php declare(strict_types=1);

namespace Caremi\Inertia;

interface InertiaInterface
{

    public function shared(string $key, mixed $value = null): void;
    public function getShared(string $key = null);
    public function viewData(string $key, mixed $value = null): void;
    public function getViewData(string $key = null);
    public function version(string $version): void;
    public function getVersion(): string;
    public function context(string $key, mixed $value = null): void;
    public function getContext(string $key = null);
    public function setRootView(string $rootView): void;
    public function getRootView(): string;
    public function render(string $component, array $props = [], array $viewData = [], array $context = []);

}