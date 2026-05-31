<?php

namespace ClaudeStudyKit;

use Composer\Script\Event;

class Installer
{
    public static function install(Event $event): void
    {
        $io = $event->getIO();
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        $projectRoot = dirname($vendorDir);

        // パッケージ自身のディレクトリを特定
        $packageDir = $vendorDir . '/your-vendor/claude-study-kit';
        if (!is_dir($packageDir)) {
            // ローカル開発時（vendor配下でなくプロジェクトルート自体がパッケージの場合）
            $packageDir = dirname(__DIR__);
        }

        $stubsDir = $packageDir . '/stubs';

        $io->write('');
        $io->write('<info>[claude-study-kit]</info> Installing Claude Code study skills...');

        // コピーするディレクトリの定義
        // スキップする条件: すでにファイルが存在する（ユーザーの編集を上書きしない）
        $dirs = [
            '.claude/skills/study',
            '.claude/skills/hint',
            '.claude/skills/review',
            '.claude/skills/next',
            '.claude/skills/diagnose',
            '.study/_session',
            '.study/_templates',
        ];

        foreach ($dirs as $dir) {
            $targetDir = $projectRoot . '/' . $dir;
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
        }

        // スタブファイルをプロジェクトルートへコピー（既存ファイルは上書きしない）
        self::copyStubs($stubsDir, $projectRoot, $io);

        $io->write('');
        $io->write('<info>[claude-study-kit]</info> Done!');
        $io->write('<info>[claude-study-kit]</info> Run <comment>/study</comment> in Claude Code to set up your learning environment.');
        $io->write('');
    }

    private static function copyStubs(string $stubsDir, string $projectRoot, $io): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($stubsDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $relativePath = str_replace($stubsDir . DIRECTORY_SEPARATOR, '', $item->getPathname());
            $targetPath = $projectRoot . DIRECTORY_SEPARATOR . $relativePath;

            if ($item->isDir()) {
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }
                continue;
            }

            if (file_exists($targetPath)) {
                $io->write(sprintf(
                    '  <comment>skip</comment>  %s (already exists)',
                    $relativePath
                ));
                continue;
            }

            copy($item->getPathname(), $targetPath);
            $io->write(sprintf(
                '  <info>create</info> %s',
                $relativePath
            ));
        }
    }
}
