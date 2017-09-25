<?php

namespace CheAlex\ImageStorageBundle\Command;

use CheAlex\ImageStorage\Application\Service\Image\SyncFileStorageRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SyncFileStorageCommand
 * @package CheAlex\ImageStorageBundle\Command
 */
class SyncFileStorageCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('che-alex-image-storage:sync-file-storage')
            ->setDescription('Synchronize database and file directory.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appService = $this->getContainer()
            ->get('che_alex_image_storage.application.service.image.sync_file_storage_service');
        $appRequest = new SyncFileStorageRequest();
        $appResponse = $appService->execute($appRequest);

        $output->writeln(sprintf('Added "%d" new images.', $appResponse->getCountNewImages()));
    }
}
